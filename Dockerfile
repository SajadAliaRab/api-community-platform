# Use the official PHP image with Apache server
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# Copy custom Apache configuration file
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable custom Apache configuration
RUN a2dissite 000-default.conf && a2ensite 000-default.conf

# Install PHP dependencies
RUN composer install

# Create uploads directory and set permissions
RUN mkdir -p /var/www/public/uploads \
    && chown -R www-data:www-data /var/www/public/uploads \
    && chmod -R 755 /var/www/public/uploads

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
