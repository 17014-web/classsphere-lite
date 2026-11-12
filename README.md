# ClassSphere Lite

A lightweight, zero-dependency PHP learning-space starter for schools. This first version is a **front-end prototype**, not a production classroom system: it does not yet include accounts, role permissions, a database connection, teacher tools, or live audio/video.

## Included

- Responsive indigo-and-mint dashboard and lesson page.
- PHP-rendered page shell with a small allow-list for page selection.
- Browser online/offline indicator.
- A text-based Introduction to Biology lesson.
- Lesson notes and completion saved in the current browser with `localStorage`.
- An approximate page-resource transfer estimate when the browser exposes Performance API sizes. It is not a guaranteed network-level data measurement.
- Keyboard skip link, visible focus styles, and reduced-motion support.
- Vanilla JavaScript and CSS; no external fonts, image requests, frameworks, or paid services.

## Requirements

- PHP 8.0+ (PHP 7.4 may work, but PHP 8 is recommended).
- A modern browser with JavaScript enabled.

MySQL/MariaDB is not required by this prototype because it does not persist server-side user data yet.

## Run locally

From the project directory:

```bash
php -S 127.0.0.1:8080
```

Open <http://127.0.0.1:8080>. `index.php` redirects to the learning-space overview. You can also open the lesson directly at <http://127.0.0.1:8080/app.php?page=lesson>.

## Local storage and privacy

Lesson notes and completion are stored only in the browser's local storage on the current device. They are not encrypted, synced, or backed up. Clearing browser data removes them. Do not use this prototype to store sensitive student information.

The connection indicator reports the browser's `navigator.onLine` state; it cannot guarantee that the internet or server is reachable. The data estimate is approximate and may show zero where transfer sizes are unavailable or the page is served from cache.

## Development roadmap

1. Review the UI and interaction prototype.
2. Add environment-based MySQL configuration and a reviewed schema.
3. Implement secure authentication, session handling, and server-side role authorization before adding student records.
4. Add school/classroom and teacher-managed lesson workflows.
5. Add durable progress syncing, safe retries, and tested offline behavior.
6. Evaluate low-bandwidth WebRTC options only after classroom requirements and infrastructure are established.

Do not treat the current local browser storage as a substitute for server-side access control or durable student records.
