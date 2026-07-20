# Royal Harvest

The public website + admin panel for **Royal Harvest**, a professional beauty & styling
training academy. Built with Laravel 13, Tailwind CSS 4 and Vite.

Split out from the original combined `royalhar` app — this repo is the **company/academy**
half. The salon lives in the sibling `royalharvest-salon` repo.

## Features

- Elegant luxury design shared with the salon (gold + charcoal + cream)
- Home, About, Programmes (schools), How-to-Apply, Blog, Contact
- Course **application** form with validation (creates candidate records)
- Admin panel (`/admin`) — dashboard, programmes CRUD, applications, blog (with image
  upload), messages

## Local setup

```bash
composer install
npm install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link      # for blog image uploads
npm run build                 # or `npm run dev` for hot reload
php artisan serve --port=8001
```

Local dev uses **SQLite** (`database/database.sqlite`). For production, switch to
MySQL via the commented block in `.env.example`.

**Demo admin:** `admin@royalharvest.co.tz` / `password`

## Cross-site link

`config/site.php` reads `SALON_URL` (default `http://localhost:8002`) to link to the
Pixies Bridal Saloon site. Business info: `COMPANY_PHONE`, `COMPANY_EMAIL`,
`COMPANY_ADDRESS`, and the `COMPANY_*` social env vars.
