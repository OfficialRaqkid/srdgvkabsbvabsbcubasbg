# Use official PHP 8.2 image with Node and npm
FROM php:8.2-cli

# Install required system packages and Node.js + npm
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Expose Laravel (8000) and Vite (5173) ports
EXPOSE 8000 5173

# Run npm install, npm run dev, and php artisan serve
CMD bash -c "npm install && npm run dev & php artisan serve --host=0.0.0.0 --port=8000"
