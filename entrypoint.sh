#!/bin/sh

# Entrypoint Script

# Setup Project Dependencies
composer install -o

# Execute database migrations
php ./bin/hyperf.php migrate

# Keep live
tail -f /dev/null

## Setup program
#php ./bin/hyperf.php start
