#!/bin/bash
echo "Waiting for the database to be ready..."
/wait-for-it.sh db:3306 -t 60

echo "Running bybit.php..."
php /var/www/html/bybit.php

echo "Starting Apache server in the background..."
apache2-foreground &

echo "Running bot.php in the background..."
php /var/www/html/bot.php &

# Keep the script running to keep the container alive
wait