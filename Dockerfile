# Use official PHP CLI image (lock to a specific version, e.g. 8.2)
FROM php:8.2-cli

# Install required PHP extensions and tools
RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    && docker-php-ext-install pcntl \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install dependencies without interaction
RUN composer install --no-interaction --prefer-dist

CMD ["php", "run.php"]
