# Deployment Requirements

## Required PHP Extensions

For this Laravel + Filament portfolio to work on your hosting, ensure these PHP extensions are enabled:

### Critical Extensions
- **pdo_sqlite** - SQLite database driver (for database access)
- **intl** - Internationalization library (for Filament number/date formatting)
- **mbstring** - Multibyte string functions
- **json** - JSON functions
- **ctype** - Character type functions

### Enabling Extensions on Shared Hosting

#### Via cPanel:
1. Log in to cPanel
2. Go to **Select PHP Version** (or **MultiPHP Manager**)
3. Click on your domain
4. Find **PHP 8.2** configuration
5. Enable these extensions:
   - Intl (International PHP Extension)
   - SQLite3 / PDO SQLite
   - Mbstring
   - JSON
   - Ctype

#### Via Plesk:
1. Hosting → Subscriptions → Your Domain
2. PHP Settings
3. Enable required extensions

#### Contact Support:
If your hosting panel doesn't allow extension management, contact support requesting:
```
Please enable these PHP 8.2 extensions:
- php8.2-intl
- php8.2-sqlite3 (or php8.2-pdo-sqlite)
- php8.2-mbstring
- php8.2-json
- php8.2-ctype
```

## Deployment Checklist

- [ ] PHP version is 8.2+
- [ ] Required extensions enabled (especially **intl** and **sqlite3**)
- [ ] Document root points to `public/` folder
- [ ] `storage/` and `bootstrap/cache/` directories writable (755)
- [ ] `.env` file created with correct `APP_KEY` and `DB_DATABASE` path
- [ ] Database migrated: `php artisan migrate`
- [ ] Cache cleared: `php artisan config:clear`

## Common Issues

### 403 Forbidden on `/admin`
- Ensure user model has `canAccessPanel()` method
- Clear cache: `php artisan config:clear`

### SQLite "could not find driver"
- Install `php8.2-sqlite3` extension

### Intl extension error
- Install `php8.2-intl` extension
- Restart PHP service or ask hosting to do it

### Cannot write to storage
- Set directory permissions to 775: `chmod -R 775 storage bootstrap/cache`
