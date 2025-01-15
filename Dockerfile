# الخطوة 1: استخدام صورة أساسية
FROM php:8.2-apache

# الخطوة 2: تثبيت متطلبات إضافية (إذا لزم الأمر)
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    apt-get update && apt-get install -y git unzip

# الخطوة 3: نسخ ملفات المشروع إلى المسار الافتراضي في Apache
COPY . /var/www/html

# الخطوة 4: إعداد الصلاحيات
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# الخطوة 5: تضمين ملف Database.sql (التعامل معه يتم في أمر docker run وليس هنا)
# لا حاجة لنسخه هنا لأننا نستخدمه كـ volume أثناء تشغيل الحاوية

# الخطوة 6: فتح المنفذ الافتراضي
EXPOSE 80

# الخطوة 7: أمر التشغيل الافتراضي
CMD ["apache2-foreground"]