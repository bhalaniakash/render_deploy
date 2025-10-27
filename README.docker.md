# Docker build & run notes

This repository includes a multi-stage `Dockerfile` that:

-   Installs Composer dependencies in a `vendor` stage.
-   Builds frontend assets in a `node` stage (if `package.json` exists).
-   Produces a final `php-fpm` image with the app, vendor, and public assets.

Quick build & run (PowerShell) — build image and run a container exposing FPM on port 9000:

```powershell
# from project root
docker build -t my-laravel-app .

# run container (example using host port mapping for testing). Note: php-fpm listens on 9000 inside container.
docker run --name my-laravel-app -p 9000:9000 -e APP_ENV=local -e APP_DEBUG=true -d my-laravel-app

# To serve the app via HTTP locally during development, consider using an nginx container or
# use a simple PHP built-in server (for quick tests only) by running a separate container that
# proxies requests to the FPM container, or use docker-compose to wire nginx + php-fpm + db.
```

Notes & tips

-   The Dockerfile uses `composer:2` and `node:18-alpine` stages — adjust node/php versions to match your CI/hosting.
-   The Dockerfile copies built assets from the `node` stage's `public` directory. If your project outputs to a different folder (e.g., `public/build`), update the `COPY --from=node_builder` line.
-   Ensure you provide an `.env` to the running container (do not bake secrets into the image). For production, use environment variables / secret managers.
-   For a full local stack, add a `docker-compose.yml` with services: app (this image), nginx, database (mysql/postgres), and optionally redis.

If you want, I can also:

-   Create a `docker-compose.yml` that wires nginx + php-fpm + mariadb for local testing.
-   Modify the Dockerfile to run migrations and queue workers as part of an entrypoint script.
