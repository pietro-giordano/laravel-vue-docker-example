# Use PHP with Apache as the base image
FROM php:8.2-apache 

# Install Additional System Dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    curl \
    gnupg \
    build-essential

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip

# Configure Apache DocumentRoot to point to Laravel's public directory
# and update Apache configuration files
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash
RUN apt-get install -y nodejs 

# Copy the application code
# COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
# ENV COMPOSER_ALLOW_SUPERUSER=1
# RUN composer install

# Install project dependencies using npm
# RUN npm install

# # Build the assets
# RUN npm run build

# # Set permissions
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
# # Set permissions for storage and cache directories
# RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# # Expose port 80
# EXPOSE 80

# # Start Apache in the foreground
# CMD ["apache2-foreground"]
