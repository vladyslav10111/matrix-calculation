# Використовуємо образ PHP з Apache
FROM php:8.2-apache

# Копіюємо файли з вашого проєкту в контейнер
COPY . /var/www/html/

# Встановлюємо робочу директорію на папку public
WORKDIR /var/www/html/

# Включаємо mod_rewrite для Apache (може знадобитись для URL-резервування)
RUN a2enmod rewrite

# Вказуємо, що веб-сервер Apache буде слухати порт 80
EXPOSE 80

# Стандартна команда для запуску Apache
CMD ["apache2-foreground"]