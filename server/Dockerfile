FROM alpine/git:v2.32.0 as wait
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/2.8.0/wait /wait

FROM php:8.1.6-cli-buster

ARG user=dev
ARG uid=1000

RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    git \
    unzip \
    procps

RUN docker-php-ext-install \
    pdo_mysql \
    sockets \
    pdo_pgsql \
    pcntl

RUN echo "UTC" > /etc/timezone

COPY --from=wait /wait /wait
RUN chmod +x /wait

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /app

COPY . .

RUN chown -R $user:$user /app

USER $user

CMD /wait && php -S 0.0.0.0:8080 -t public
