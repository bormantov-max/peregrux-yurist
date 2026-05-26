# Design System — Peregruz Yurist Landing

## 1. Purpose

This document defines the visual and UX rules for the landing page about legal assistance with contesting truck overweight fines in Russia.

The website must look strict, professional, trustworthy, modern, and practical.  
It must not look like an aggressive info-business landing page, a cheap legal template, or an overdecorated corporate website.

Main user state: stress, urgency, large fine, need for quick legal assessment.

Main conversion action: send a fine notice for initial review.

---

## 2. Brand Feeling

The design must communicate:

- legal reliability;
- transport industry specificity;
- urgency without panic;
- clarity;
- professional restraint;
- practical help;
- federal remote service.

Avoid:

- fake luxury;
- aggressive sales design;
- excessive animation;
- glossy stock photos;
- random icons;
- decorative legal clichés;
- court hammer as the main visual;
- fake government symbols.

---

## 3. Color Palette

Use CSS variables.

Primary dark:
`#0F172A`

Secondary dark:
`#1E293B`

Light section background:
`#F8FAFC`

White:
`#FFFFFF`

Primary text:
`#111827`

Secondary text:
`#64748B`

CTA accent:
`#F59E0B`

Trust / success accent:
`#22C55E`

Warning / urgency accent:
`#EF4444`

Borders:
`#E2E8F0`

Do not use red as the main brand color.  
Red may only be used for warnings, deadlines, and urgent notes.

---

## 4. Typography

Use system font stack:

`Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif`

H1 desktop:
48–56px  
font-weight: 700–800  
line-height: 1.05–1.15

H1 mobile:
32–38px  
font-weight: 700–800

H2 desktop:
32–40px  
font-weight: 700

H2 mobile:
26–30px  
font-weight: 700

Body:
16–18px  
line-height: 1.55–1.7  
font-weight: 400

Small text:
14px minimum

Do not use decorative fonts.  
Do not use serif fonts for interface text.

---

## 5. Layout

Use a clean responsive layout.

Max content width:
1180–1240px

Section padding desktop:
80–110px top and bottom

Section padding mobile:
48–64px top and bottom

Container side padding:
20px mobile  
32px tablet  
40px desktop

Use enough whitespace.  
Do not overload the first screen.

---

## 6. Grid Rules

Desktop:
- 2-column layout for hero;
- 3-column or 4-column grids for cards;
- 2-column layout for content-heavy sections.

Tablet:
- 2-column cards where possible.

Mobile:
- all cards in one column;
- hero becomes one column;
- CTA buttons stack vertically.

No horizontal scrolling is allowed.

---

## 7. Cards

Cards must look clean and functional.

Card style:
- background: white;
- border: 1px solid `#E2E8F0`;
- border-radius: 20–24px;
- padding: 24–32px;
- subtle shadow only if needed;
- no heavy shadows;
- no neon effects.

Hover:
- slight lift: translateY(-2px to -4px);
- border or shadow may become slightly stronger.

Do not use overly bright gradients inside cards.

---

## 8. Buttons

Primary CTA:
- background: `#F59E0B`;
- text: dark or white depending on contrast;
- border-radius: 999px or 14–16px;
- height: minimum 48px desktop, 44px mobile;
- font-weight: 700;
- clear action text.

Primary CTA texts:
- Отправить постановление на анализ
- Получить первичный анализ
- Проверить постановление

Secondary CTA:
- border: 1px solid rgba(255,255,255,0.3) on dark backgrounds;
- or border: 1px solid `#CBD5E1` on light backgrounds;
- background transparent or white;
- text must be readable.

Secondary CTA texts:
- Написать в Telegram
- Позвонить

Do not use vague buttons like:
- Отправить
- Подробнее
- Подтвердить
unless context is very clear.

---

## 9. Header

Header must be sticky.

Desktop header:
- logo/name left;
- navigation center or right;
- phone and CTA button right.

Mobile header:
- logo/name;
- phone or Telegram button;
- compact menu if needed.

Header background:
- white with light border;
- or dark transparent over hero, becoming solid on scroll.

Header must not take too much vertical space.

---

## 10. Hero Section

Hero must be clear within 3 seconds.

Hero requirements:
- dark background;
- one clear H1;
- short explanatory subtitle;
- two CTA buttons;
- micro-trust row;
- right-side visual card instead of heavy photo in the first prototype.

Hero visual:
Use a UI-style document card:
- title: Постановление о штрафе;
- amount: 150 000–600 000 ₽;
- status: Требуется проверка;
- tags: масса, оси, рамка, Ространснадзор;
- document-like lines;
- no real personal data.

Do not use:
- stock smiling lawyers;
- court hammer as the main hero visual;
- fake government emblems;
- overloaded background images.

---

## 11. Trust Bar

Trust bar must appear close to the hero.

Use 4–5 compact items:
- По всей России
- Дистанционно
- Анализ по фото постановления
- Штрафы по массе и осям
- Ространснадзор и ГИБДД

Do not use unverified numbers:
- 500+ дел
- 95% успеха
- 10 лет практики
unless real and confirmed.

---

## 12. Case / Situation Cards

If real legal cases are unavailable, use “Примеры ситуаций”, not fake cases.

Situation cards may include:
- neutral document preview mockup;
- problem type;
- short explanation;
- CTA.

Document preview must:
- look like a blurred/anonymous document;
- show no personal data;
- not imitate official documents too closely;
- not contain fake case numbers.

If real scans are later added:
- all personal data must be anonymized;
- use preview image in card;
- full scan opens in modal/lightbox;
- do not place huge scans directly inside the page.

---

## 13. Forms

Forms must be short.

Fields:
- name;
- phone;
- optional comment;
- consent checkbox.

Phone field:
`type="tel"`

Form button:
`Получить анализ постановления`

After prototype submission:
show local success message, no server submission.

Form must not ask for:
- INN;
- passport;
- full company details;
- email as required field;
- file upload in the first prototype.

---

## 14. FAQ

FAQ must use accordion behavior.

FAQ style:
- clear question;
- compact answer;
- border-bottom or card style;
- good mobile readability.

Answers must be legally careful.

Do not guarantee legal outcomes.

---

## 15. Floating Telegram Button

Use a floating Telegram button.

Position:
bottom right

Desktop:
24px from bottom and right

Mobile:
16px from bottom and right

It must not cover form buttons or important text.

Link:
`https://t.me/mlynchak_consult`

---

## 16. Legal Tone

Allowed phrases:
- Оценим перспективы обжалования
- Проверим постановление
- Подготовим жалобу
- Поможем разобраться в основаниях штрафа
- Сопроводим процесс обжалования
- Первичный анализ постановления
- Достаточно фото или скана постановления

Forbidden phrases:
- Гарантируем отмену штрафа
- Отменим любой штраф
- 100% результат
- 99% выигранных дел
- Победа гарантирована
- Не отменим — не платите
- Вернём деньги гарантированно
- Лучшие юристы России

---

## 17. Animation

Use minimal animation only.

Allowed:
- subtle hover effects;
- smooth scroll;
- soft fade/slide on simple elements if lightweight.

Forbidden:
- heavy parallax;
- excessive scroll animation;
- animated counters with fake numbers;
- blinking CTA buttons;
- distracting moving backgrounds.

---

## 18. Accessibility

Requirements:
- buttons must have visible focus states;
- interactive elements must be keyboard accessible;
- popup closes with Esc;
- popup closes by clicking outside;
- contrast must be sufficient;
- font size must be readable;
- clickable areas minimum 44px on mobile.

---

## 19. Technical Design Rules

Use:
- semantic HTML;
- CSS variables;
- responsive CSS;
- no horizontal scroll;
- no external UI libraries;
- no Bootstrap;
- no jQuery;
- no heavy scripts;
- clean readable class names.

Preferred file for first prototype:
`index.html`

All CSS and JS may be inside the file for MVP.

---

## 20. Contacts

Use only these contacts:

Phone:
`+7 903 912-82-12`

Phone link:
`tel:+79039128212`

Telegram:
`@mlynchak_consult`

Telegram link:
`https://t.me/mlynchak_consult`

MAX:
by phone number `+7 903 912-82-12`

Do not use WhatsApp.
Do not use email as the main communication channel.

---

## 21. Final Quality Check

Before finishing any design or code task, check:

- Is the first screen clear in 3 seconds?
- Is the main CTA visible without scrolling?
- Are there no forbidden legal guarantees?
- Are contacts correct?
- Is Telegram clickable?
- Is phone clickable?
- Is mobile layout clean?
- Are cards readable?
- Are fake cases/counters absent?
- Is the design strict and professional?
- Is there no horizontal scroll?
