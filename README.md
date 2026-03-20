# Portfolio (Laravel + Vue)

Personal portfolio application with:

- Laravel backend (API, admin panel, data models)
- Vue 3 frontend SPA (served from Laravel)
- Single-project deployment (frontend + backend in one repo)

## Tech Stack

- PHP / Laravel
- Vue 3 + Vue Router
- Vite
- Tailwind CSS
- Filament (admin)

## Project Structure

- `app/`, `routes/`, `database/` → Laravel backend
- `resources/js/` → Vue SPA source
- `resources/css/app.css` → Tailwind styles
- `resources/views/app.blade.php` → SPA entry blade
- `public/build/` → built frontend assets (tracked in git)

## API (Public)

Base path: `/api/v1`

- `GET /profile`
- `GET /projects`
- `GET /projects/featured`
- `GET /projects/{id}`
- `GET /skills`
- `GET /experiences`
- `POST /contact`

## Local Development

### 1) Install dependencies

```bash
composer install
npm install
```

### 2) Environment

```bash
cp .env.example .env
php artisan key:generate
```

Set values in `.env` as needed (DB, mail, app URL).

Recommended for merged SPA/API:

```env
VITE_API_URL=/api/v1
```

### 3) Database

```bash
php artisan migrate --seed
```

### 4) Run app

```bash
php artisan serve
npm run dev
```

## Production Build

```bash
npm run build
```

This generates frontend assets in `public/build`.

## Deployment Notes

- Deploy this single project.
- Point web root to `public/`.
- Ensure `.env` is configured for production.
- Run:

```bash
php artisan migrate --force
php artisan optimize
```

## License

MIT
