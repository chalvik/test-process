FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip zip wget libzip-dev \
    && docker-php-ext-install zip pcntl

WORKDIR /app

COPY . .

CMD ["php", "run.php"]
