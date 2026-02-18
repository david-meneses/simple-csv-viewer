# Simple CSV Viewer (Laravel 12)

A minimal Laravel application to:
- Upload a CSV file
- Store each row as JSON in the database
- Download the latest row in JSON (TXT file) or XML format

## Requirements

- Docker Desktop (or Docker Engine + Docker Compose)

## Run with Docker

1. Build the images:

```bash
docker compose build
```

2. Start containers:

```bash
docker compose up -d
```

3. Open the app:

```text
http://localhost:8080
```

The app container entrypoint automatically handles first-run setup:
- creates `.env` from `.env.example` (if missing)
- installs PHP dependencies if `vendor/` is missing
- creates `database/database.sqlite` (if missing)
- generates `APP_KEY` (if missing)
- runs migrations

## Useful Commands

- Stop containers:

```bash
docker compose down
```

- Rebuild from scratch:

```bash
docker compose down --volumes
docker compose build --no-cache
docker compose up -d
```

- View logs:

```bash
docker compose logs -f
```

- Enter app container shell:

```bash
docker compose exec app sh
```

- Run tests:

```bash
docker compose exec app php artisan test
```

## Project Notes

- Web server: Nginx (`nginx:alpine`)
- PHP runtime: PHP-FPM 8.4
- Framework: Laravel 12
- Default DB in this setup: SQLite (`database/database.sqlite`)
- Application port on host: `8080`

## Troubleshooting

- If dependencies look missing:

```bash
docker compose exec app composer install
```

- If permissions fail on `storage` or `bootstrap/cache`:

```bash
docker compose exec app sh -lc "chown -R www-data:www-data storage bootstrap/cache database"
```

- If migrations need to be rerun:

```bash
docker compose exec app php artisan migrate:fresh --force
```
