# Use an official PHP image with Node and Composer installed
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www/html

# Copy all files to container
COPY . .

# Install PHP dependencies
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    composer install

# Install Node dependencies
RUN npm install

# Expose Laravel (8000) and Vite (5173) ports
EXPOSE 8000 5173

# Run npm dev and Laravel serve together
CMD bash -c "npm run dev & php artisan serve --host=0.0.0.0 --port=8000"
