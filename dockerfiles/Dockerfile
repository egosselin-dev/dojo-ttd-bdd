FROM ubuntu:18.04

ENV DEBIAN_FRONTEND noninteractive

ADD ./app.conf /etc/apache2/sites-available/

# Configure & install PHP
RUN apt-get update && apt-get -y install apache2 php php-mysql php7.2-bcmath php-bcmath \
  && apt-get -y install php-xml php-curl php-mbstring \
  && sed -i 's!display_errors = Off!display_errors = On!g' /etc/php/7.2/apache2/php.ini \
  && a2enmod rewrite && a2enmod headers && a2dissite 000-default && a2ensite app

WORKDIR /var/www/html

# Misc dependencies
RUN apt-get install -y git zip

# Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php composer-setup.php && php -r "unlink('composer-setup.php');" \
  && mv composer.phar /usr/local/bin/composer

EXPOSE 80
EXPOSE 443

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
