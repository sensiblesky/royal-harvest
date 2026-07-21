# Royal Harvest — Production Deployment

Laravel 13 + Tailwind 4. Multi-venture group site: ventures, beauty academy
(programmes + applications), blog, admin panel.

## Requirements
- PHP 8.3+ (ext: pdo_mysql, mbstring, openssl, curl, gd)
- MySQL 8+ (or MariaDB 10.4+)
- Node 18+ (build only), Composer 2
- A public HTTPS domain

## First deploy
```bash
composer install --no-dev --optimize-autoloader
cp .env.example .env          # then edit values
php artisan key:generate
npm ci && npm run build
php artisan migrate --force --seed
php artisan storage:link      # blog image uploads
php artisan config:cache route:cache view:cache
```

## Required .env values
- `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://your-domain`
- Database: `DB_*` (MySQL)
- `COMPANY_WHATSAPP` (digits only), `COMPANY_PHONE/EMAIL/ADDRESS`, `SALON_URL`
- Optional: `ANALYTICS_GA_ID`

## Post-deploy checklist
1. **Change the admin password** — default is `admin@royalharvest.co.tz` / `password`.
   Log in → **My Profile**. (Or edit the seeder before first seed.)
2. Add real ventures/programmes/blog content in the admin panel.
3. Point document root at `public/`. Force HTTPS.
4. Ensure `storage/` and `bootstrap/cache/` are writable.

## Updating
```bash
git pull && composer install --no-dev -o && npm ci && npm run build
php artisan migrate --force
php artisan config:cache route:cache view:cache
```

## Included production features
- Security headers via middleware
- SEO: meta, Open Graph/Twitter, JSON-LD, sitemap.xml (incl. blog posts), robots.txt
- WhatsApp float, click-to-call, back-to-top, cookie notice
- Custom error pages (404/403/419/500/503)
- Admin: ventures/programmes/blog/applications CRUD + profile & password change

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
