# Multi-stage Dockerfile for Laravel (Node build + PHP-FPM + nginx)
# Base Node stage to build frontend assets
FROM node:18 AS node-build
WORKDIR /app
COPY package*.json ./
RUN npm ci --silent
COPY . .
RUN npm run prod

# PHP runtime stage
FROM php:8.1-fpm

# Install system packages and PHP extensions required for Laravel
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    libpng-dev \
    libzip-dev \
    zip unzip \
    git curl \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
  && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer binary from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application code
COPY . /var/www/html

# Copy compiled frontend assets from node-build stage
COPY --from=node-build /app/public /var/www/html/public

# Create directories and set ownership (www-data)
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/images \
  && chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html \
  && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/images || true

# Add nginx config and entrypoint
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

# Start the container via entrypoint
CMD ["/entrypoint.sh"]