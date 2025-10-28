# Deploying this Laravel app to Render (Docker)

This repository includes a simple Dockerfile and `render.yaml` to deploy the app to Render using a Docker web service.

Quick steps:

1. Push your repo to a Git provider connected to Render (GitHub, GitLab, or Bitbucket).
2. In Render, create a new service and choose "Deploy from a repository" using this repo, or let Render pick up `render.yaml` automatically.
3. Configure environment variables in the Render dashboard (do NOT upload your .env). At minimum set:

    - APP_KEY (use `php artisan key:generate --show` locally to get a key)
    - DB_CONNECTION=pgsql
    - DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
    - APP_URL (the URL Render provides for your service)
    - SESSION_DRIVER=file (or set up DB sessions and migrate)

4. Deploy. The Dockerfile will run `composer install` and attempt to run migrations (the Docker CMD runs `php artisan migrate --force || true`).

Notes and caveats:

-   This Dockerfile uses `php artisan serve` for simplicity. For production-grade usage, consider using nginx + php-fpm.
-   Keep secrets out of the repo; set them in Render's Environment settings or as secret files.
-   If you need to run `npm run build`, add Node and the build steps to the Dockerfile or pre-build assets and push them.
-   If you prefer not to use Docker, Render also supports PHP/Composer buildpacks.
