FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libzip-dev zip nodejs npm

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN npm install && npm run build

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/build

RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/build

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/s|AllowOverride None|AllowOverride All|' /etc/apache2/apache2.conf

EXPOSE 80

CMD apache2-foreground