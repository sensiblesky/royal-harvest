# Pixies Bridal Saloon — Production Deployment

Laravel 13 + Tailwind 4. Booking with 10% deposit (Snippe), SMS (Beem), admin panel.

## Requirements
- PHP 8.3+ (ext: pdo_mysql, mbstring, openssl, curl, gd or imagick for PDFs)
- MySQL 8+ (or MariaDB 10.4+)
- Node 18+ (build only), Composer 2
- A public HTTPS domain

## First deploy
```bash
composer install --no-dev --optimize-autoloader
cp .env.example .env          # then edit values (see below)
php artisan key:generate
npm ci && npm run build
php artisan migrate --force --seed
php artisan storage:link
php artisan config:cache route:cache view:cache
```

## Required .env values
- `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://your-domain`
- Database: `DB_*` (MySQL)
- `SALON_WHATSAPP` (digits only, e.g. 255759389897), `SALON_PHONE/EMAIL/ADDRESS`
- Optional: `ANALYTICS_GA_ID` (Google Analytics)

Payment & SMS keys are best set in the **admin panel** (`/admin/settings`) — they are
stored encrypted in the database. `.env` acts as a fallback.

## Post-deploy checklist
1. **Change the admin password** — default is `admin@pixiesbridal.co.tz` / `password`.
   Log in → **My Profile** → change password & email. (Or edit the seeder before first seed.)
2. In **/admin/settings**: add Snippe API key, Beem API key + secret, admin alert phone.
3. Register the webhook URL `https://your-domain/webhooks/snippe` in the Snippe dashboard.
4. Queue worker (for any queued jobs): `php artisan queue:work` via supervisor/systemd.
5. Point the web server document root at `public/`. Force HTTPS.

## Web server notes
- Nginx: standard Laravel config, `try_files $uri $uri/ /index.php?$query_string;`
- Ensure `storage/` and `bootstrap/cache/` are writable by the web user.

## Updating
```bash
git pull && composer install --no-dev -o && npm ci && npm run build
php artisan migrate --force
php artisan config:cache route:cache view:cache
```

## Included production features
- Security headers (X-Frame-Options, HSTS, nosniff, etc.) via middleware
- SEO: per-page meta, Open Graph/Twitter cards, JSON-LD, sitemap.xml, robots.txt
- WhatsApp float, click-to-call, back-to-top, cookie notice
- Custom error pages (404/403/419/500/503)
- Encrypted API keys in DB; deposit + dual SMS (customer receipt + admin alert)

---

## Troubleshooting

### "The GET method is not supported for route /. Supported methods: HEAD."
This is a **stale/corrupt route cache** on the server. Fix:
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
# then rebuild cleanly:
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
Never commit `bootstrap/cache/*.php` — each server builds its own (now in .gitignore).

### URL shows "/public/" (e.g. https://site.co.tz/public/)
The web server document root is wrong. It must point to the **`public/`** folder,
NOT the project root.

- **cPanel / shared hosting**: either set the domain's "Document Root" to
  `.../royalharvest/public`, OR put this in a `.htaccess` at the project root to
  forward requests into public/ (fallback only — setting the docroot is better):
  ```apache
  <IfModule mod_rewrite.c>
      RewriteEngine On
      RewriteRule ^(.*)$ public/$1 [L]
  </IfModule>
  ```
- **Nginx**: `root /var/www/royalharvest/public;`
- Confirm `public/.htaccess` (shipped with Laravel) exists for pretty URLs on Apache.

After fixing the docroot, the site loads at `https://site.co.tz/` (no `/public/`).
