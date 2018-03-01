FROM php:7-cli

RUN useradd -ms /bin/bash app && usermod -aG sudo app

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" &&\
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer &&\
    php -r "unlink('composer-setup.php');"
