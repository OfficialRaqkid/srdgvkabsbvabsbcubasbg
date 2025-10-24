# Stage 1: Build frontend
FROM node:20 AS frontend

# Set working directory
WORKDIR /app

# Copy package files and install dependencies
COPY package*.json ./
RUN npm install

# Copy all project files
COPY . .

# Stage 2: Laravel + Node runtime
FROM php:8.2-cli

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files from the previous stage
WORKDIR /var/www/html
COPY --from=frontend /app .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist

# Expose Laravel’s and Vite’s ports
EXPOSE 8000 5173

# Copy startup script
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Run both servers
CMD ["bash", "/usr/local/bin/start.sh"]
