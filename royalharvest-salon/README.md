# Pixies Bridal Saloon

The public website + admin panel for **Pixies Bridal Saloon**, a premium beauty salon
(part of the Royal Harvest group). Built with Laravel 13, Tailwind CSS 4 and Vite.

Split out from the original combined `royalhar` app — this repo is the **salon** half.
The training academy lives in the sibling `royalharvest-company` repo.

## Features

- Elegant luxury design (gold + charcoal + cream, Cormorant Garamond + Jost)
- Home, Services, Gallery (lightbox), About, Contact
- Appointment **booking** with validation + downloadable **PDF confirmation** (dompdf)
- Newsletter subscribe
- Admin panel (`/admin`) — dashboard, bookings, services CRUD, messages, subscribers

## Local setup

```bash
composer install
npm install
php artisan key:generate
php artisan migrate:fresh --seed
npm run build                # or `npm run dev` for hot reload
php artisan serve --port=8002
```

Local dev uses **SQLite** (`database/database.sqlite`). For production, switch to
MySQL via the commented block in `.env.example`.

**Demo admin:** `admin@pixiesbridal.co.tz` / `password`

## Cross-site link

`config/site.php` reads `COMPANY_URL` (default `http://localhost:8001`) to link back to
the Royal Harvest academy site. Business info: `SALON_PHONE`, `SALON_EMAIL`,
`SALON_ADDRESS`, and the `SALON_*` social env vars.
