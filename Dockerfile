FROM php:8.3-apache

COPY index.html spielstand.php /var/www/html/

# /data = Ablage für den Spielstand (in Coolify als Volume mounten, dann
# überlebt er Redeploys). Fallback: /var/www/html, daher auch beschreibbar.
RUN mkdir -p /data \
    && chown -R www-data:www-data /data /var/www/html

EXPOSE 80
