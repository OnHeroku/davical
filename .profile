#!/usr/bin/env bash
echo "Include /app/www/httpd.conf" >> /app/apache/conf/httpd.conf
mv /app/www/config.php /app/www/davical/config/config.php
