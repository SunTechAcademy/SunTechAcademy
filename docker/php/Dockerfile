FROM php:8.3.36-fpm-bookworm

# Reject runtimes without the PHP2shell security fixes.
COPY src/scripts/check-php-security.php /usr/local/lib/check-php-security.php
RUN php /usr/local/lib/check-php-security.php

# 必要なパッケージとPHP拡張モジュールのインストール
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql pdo_pgsql pgsql zip

# Node.jsとnpmのインストール (Breezeのフロントエンドビルド用)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html