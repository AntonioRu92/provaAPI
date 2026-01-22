# Netlify Klaviyo Webhook

Files created:
- `netlify/functions/klaviyo-webhook.js` - Netlify Function that verifies HMAC-SHA256 (base64) signature and logs payload.
- `netlify.toml` - Netlify config pointing to functions folder.
- `package.json` - contains `netlify dev` script for local dev.
- `scripts/generate-signature.sh` - helper to generate signature for testing.

Quick steps

1. Commit and push this repo to GitHub:

```bash
git add .
git commit -m "Add Netlify function and test scripts for Klaviyo webhook"
git push origin main
```

2. In Netlify UI (Site → Site settings → Build & deploy → Environment), add:

- `WC_WEBHOOK_SECRET` = <la_tua_chiave_segreta>

3. Connect repository on Netlify (New site → GitHub → choose repo) and deploy.

4. After deploy, the webhook endpoint will be:

```
https://<tuo-sito>.netlify.app/.netlify/functions/klaviyo-webhook
```

5. Test the webhook (locally or after deploy):

Generate signature:

```bash
payload='{"id":123,"status":"created"}'
SECRET='la_tua_chiave_segreta'
sig=$(echo -n "$payload" | openssl dgst -sha256 -hmac "$SECRET" -binary | base64)

curl -v \
  -H "Content-Type: application/json" \
  -H "X-WC-Webhook-Signature: $sig" \
  -d "$payload" \
  https://<tuo-sito>.netlify.app/.netlify/functions/klaviyo-webhook
```

Notes
- Netlify Functions run on Node.js; if your main app is Laravel/PHP, keep that separate or forward payloads from this function to your PHP server.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# provaAPI
