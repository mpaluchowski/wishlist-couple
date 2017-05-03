FROM php:7-apache

RUN a2enmod rewrite && a2enmod headers
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80
