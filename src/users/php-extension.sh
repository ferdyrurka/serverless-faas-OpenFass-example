#!/bin/sh

echo "Installing PHP extensions"

apk --no-cache add postgresql-dev \
&& docker-php-ext-install pdo pdo_pgsql pgsql json

# list php extension
# https://gist.github.com/giansalex/2776a4206666d940d014792ab4700d80