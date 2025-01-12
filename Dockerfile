# استخدم صورة PHP مع Apache
FROM php:7.4-apache

# تثبيت الامتدادات المطلوبة (mysqli و pdo_mysql)
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd mysqli pdo pdo_mysql

# تمكين mod_rewrite في Apache (إذا كنت بحاجة إليه)
RUN a2enmod rewrite

# نسخ ملفات المشروع إلى الحاوية
COPY . /var/www/html/

# تعيين الأذونات اللازمة للملفات
RUN chown -R www-data:www-data /var/www/html

# تعيين منفذ Apache ليعمل على المنفذ 80
EXPOSE 80

# بدء Apache
CMD ["apache2-foreground"]
