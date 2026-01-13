#!/bin/bash

# Install composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Install npm dependencies and build assets
npm install
npm run build
