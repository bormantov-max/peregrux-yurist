<?php
declare(strict_types=1);

ini_set('display_errors', '0');
error_reporting(E_ALL);
header('Content-Type: application/json; charset=utf-8');

const SUCCESS_MESSAGE = 'Заявка отправлена';
const ERROR_MESSAGE = 'Не удалось отправить заявку';

function json_response(bool $success, string $message): void
{
    echo json_encode([
        'success' => $success,
        'message' => $message,
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

function post_value(string $key): string
{
    $value = $_POST[$key] ?? '';

    if (is_array($value)) {
        return '';
    }

    return (string) $value;
}

function clean_text(string $value, int $maxLength = 1000): string
{
    $value = strip_tags($value);
    $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value) ?? '';
    $value = trim(preg_replace('/[ \t]+/u', ' ', $value) ?? '');

    if (function_exists('mb_substr')) {
        return mb_substr($value, 0, $maxLength, 'UTF-8');
    }

    return substr($value, 0, $maxLength);
}

function display_value(string $value): string
{
    return $value === '' ? 'не указано' : $value;
}

function lead_id(): string
{
    try {
        return bin2hex(random_bytes(16));
    } catch (Throwable $exception) {
        return str_replace('.', '', uniqid('lead_', true));
    }
}

function client_ip(): string
{
    $keys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_REAL_IP', 'REMOTE_ADDR'];

    foreach ($keys as $key) {
        $value = $_SERVER[$key] ?? '';
        if (is_string($value) && trim($value) !== '') {
            return clean_text($value, 120);
        }
    }

    $forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '';
    if (is_string($forwarded) && trim($forwarded) !== '') {
        $parts = explode(',', $forwarded);
        return clean_text($parts[0] ?? '', 120);
    }

    return '';
}

function save_lead(array $lead, string $path): bool
{
    $directory = dirname($path);

    if (!is_dir($directory) && !@mkdir($directory, 0755, true) && !is_dir($directory)) {
        return false;
    }

    $handle = @fopen($path, 'c+');
    if ($handle === false) {
        return false;
    }

    $saved = false;

    if (@flock($handle, LOCK_EX)) {
        rewind($handle);
        $contents = stream_get_contents($handle);
        $leads = [];

        if (is_string($contents) && trim($contents) !== '') {
            $decoded = json_decode($contents, true);
            if (is_array($decoded)) {
                $leads = $decoded;
            }
        }

        $leads[] = $lead;
        $json = json_encode($leads, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if ($json !== false) {
            rewind($handle);
            if (@ftruncate($handle, 0) && @fwrite($handle, $json . PHP_EOL) !== false) {
                $saved = true;
            }
        }

        @fflush($handle);
        @flock($handle, LOCK_UN);
    }

    @fclose($handle);

    return $saved;
}

function send_telegram(array $config, string $message): bool
{
    $token = trim((string) ($config['telegram_bot_token'] ?? ''));
    $chatId = trim((string) ($config['telegram_chat_id'] ?? ''));

    if ($token === '' || $chatId === '') {
        return false;
    }

    $payload = http_build_query([
        'chat_id' => $chatId,
        'text' => $message,
        'disable_web_page_preview' => '1',
    ]);

    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $payload,
            'timeout' => 8,
            'ignore_errors' => true,
        ],
    ]);

    $url = 'https://api.telegram.org/bot' . rawurlencode($token) . '/sendMessage';
    $result = @file_get_contents($url, false, $context);

    if ($result === false) {
        return false;
    }

    $decoded = json_decode($result, true);

    return is_array($decoded) && ($decoded['ok'] ?? false) === true;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(false, ERROR_MESSAGE);
}

if (trim(post_value('website')) !== '') {
    json_response(true, SUCCESS_MESSAGE);
}

$configPath = __DIR__ . '/config.php';
if (!is_file($configPath)) {
    json_response(false, ERROR_MESSAGE);
}

$config = @include $configPath;
if (!is_array($config)) {
    json_response(false, ERROR_MESSAGE);
}

$name = clean_text(post_value('name'), 120);
$phone = clean_text(post_value('phone'), 80);
$comment = clean_text(post_value('comment'), 2000);
$page = clean_text(post_value('page'), 500);

if ($phone === '') {
    json_response(false, ERROR_MESSAGE);
}

$createdAt = date('c');
$ip = client_ip();
$userAgent = clean_text((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 500);

$lead = [
    'id' => lead_id(),
    'created_at' => $createdAt,
    'name' => $name,
    'phone' => $phone,
    'comment' => $comment,
    'page' => $page,
    'ip' => $ip,
    'user_agent' => $userAgent,
];

$message = implode("\n", [
    'Новая заявка с сайта «Юрист по перегрузу»',
    '',
    'Имя: ' . display_value($name),
    'Телефон: ' . display_value($phone),
    'Комментарий: ' . display_value($comment),
    'Страница: ' . display_value($page),
    'Дата: ' . display_value($createdAt),
    'IP: ' . display_value($ip),
]);

$leadsPath = dirname(__DIR__) . '/data/leads.json';
$saved = save_lead($lead, $leadsPath);
$sent = send_telegram($config, $message);

if ($saved && $sent) {
    json_response(true, SUCCESS_MESSAGE);
}

json_response(false, ERROR_MESSAGE);
