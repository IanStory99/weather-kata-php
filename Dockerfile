FROM php:8.1.12-zts-buster
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y git zip unzip

COPY . /app
WORKDIR /app

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN make install

CMD ["make", "tests"]
