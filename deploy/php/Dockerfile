FROM php:8.2-apache

RUN pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo_mysql

RUN  a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN echo "upload_max_filesize = 500M\n" \
    "post_max_size = 500M\n" \
    > /usr/local/etc/php/conf.d/uploads.ini
