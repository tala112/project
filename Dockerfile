# Start from a base image that includes PHP
FROM php:7.4-apache

# Install MySQL client
RUN apt-get update && apt-get install -y mysql-client

# Install other dependencies if needed
RUN docker-php-ext-install mysqli

# Copy project files into the container
COPY . /var/www/html/

# Expose the port the app will run on
EXPOSE 80