# Dockerfile corregido: Separación de PHP-FPM y Nginx recomendada
# Esta versión solo levanta PHP-FPM; Nginx debe ir en un contenedor aparte.

# Imagen base PHP-FPM
FROM php:8.2-fpm

LABEL maintainer="fernandogespindolao"
LABEL description="Proyecto ClinicaSePrise con PHP-FPM"

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copiar proyecto al contenedor
COPY ./proyectoClinicaSePrise /var/www/html

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Exponer puerto de PHP-FPM
EXPOSE 9000

# Comando por defecto
CMD ["php-fpm"]
