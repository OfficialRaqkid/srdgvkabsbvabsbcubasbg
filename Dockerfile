# Use the official PHP image with necessary extensions
FROM php:8.2-cli

# Install system dependencies and Node.js + npm
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev \
    nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www/html

# Copy the entire project
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist

# Install Node dependencies and build assets
RUN npm install

# Expose Laravel (8000) and Vite (5173) ports
EXPOSE 8000 5173

# Start both npm dev server and Laravel backend together
CMD bash -c "npm run dev & php artisan serve --host=0.0.0.0 --port=8000"
