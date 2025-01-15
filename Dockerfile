# اختر صورة من Ubuntu أو Debian كأساس
FROM ubuntu:20.04

# تثبيت الحزم الأساسية
RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    php-mysql \
    mysql-server \
    git \
    curl \
    && apt-get clean

# إعداد Apache لتشغيله على المنفذ 80
EXPOSE 80

# إعداد Apache للعمل مع PHP
COPY ./www /var/www/html/

# نسخ ملفات تكوين Apache
COPY ./apache2.conf /etc/apache2/apache2.conf

# تكوينات MySQL
COPY ./my.cnf /etc/mysql/my.cnf

# إعدادات MySQL (اختياري - يمكن تعديل كلمة المرور/الإعدادات حسب الحاجة)
RUN service mysql start && mysql -e "CREATE DATABASE IF NOT EXISTS my_database;"
RUN service mysql start && mysql -e "CREATE USER IF NOT EXISTS 'root'@'%' IDENTIFIED BY 'root';"
RUN service mysql start && mysql -e "GRANT ALL PRIVILEGES ON my_database.* TO 'root'@'%';"
RUN service mysql start && mysql -e "FLUSH PRIVILEGES;"

# بدء Apache و MySQL عند تشغيل الحاوية
CMD service mysql start && apachectl -D FOREGROUND
