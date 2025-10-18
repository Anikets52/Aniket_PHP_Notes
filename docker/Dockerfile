# Use official PHP with Apache
FROM php:8.2-apache

# Install PHP extensions required for MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (good for frameworks like Laravel/CodeIgniter)
RUN a2enmod rewrite

# Copy composer from the composer image (fast & convenient)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
# RUN composer install --no-dev --optimize-autoloader

# Set working directory
WORKDIR /var/www/html

# Copy your application source
COPY  . /var/www/html/

# Set permissions
# RUN chown -R www-data:www-data /var/www/html \
#     && chmod -R 755 /var/www/html

# Expose Apache port
EXPOSE 80
