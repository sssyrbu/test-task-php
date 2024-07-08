#!/bin/bash
echo "Waiting for the database to be ready..."
/wait-for-it.sh db:3306 -t 60

echo "Running bybit.php..."
php /var/www/html/bybit.php

echo "Starting main...."
php /var/www/html/main.php

echo "Starting Apache server..."
apache2-foreground