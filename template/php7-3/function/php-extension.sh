#!/bin/sh

echo "Installing PHP extensions"

docker-php-ext-install json

# list php extension
# https://gist.github.com/giansalex/2776a4206666d940d014792ab4700d80