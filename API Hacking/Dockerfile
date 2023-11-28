FROM php:7.4-apache

# Install the mysqli extension for connecting to a MySQL database
RUN docker-php-ext-install mysqli

# Copy the PHP application files to the Apache web root directory
COPY . /var/www/html/

RUN chmod -R 777 /var/www/html

# Expose port 80 to allow external traffic
EXPOSE 80
