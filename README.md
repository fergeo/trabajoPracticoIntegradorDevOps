# Trabajo Práctico Integrador DevOps

## Guía de Instalación y Ejecución con Docker

Este documento proporciona las instrucciones necesarias para instalar,
configurar y ejecutar el proyecto **Trabajo Práctico Integrador DevOps**
utilizando contenedores Docker. El objetivo es garantizar un entorno de
despliegue consistente, reproducible y aislado, facilitando tanto el
proceso de desarrollo como el de ejecución local.

------------------------------------------------------------------------

## 1. Requisitos Previos

Antes de comenzar, asegúrese de contar con los siguientes componentes
instalados en su sistema:

### ● Git

Utilizado para clonar el repositorio del proyecto.\
Descarga: https://git-scm.com/

### ● Docker Engine

Permite construir y ejecutar contenedores.\
Descarga: https://www.docker.com/get-started/

### ● Docker Compose (si su versión de Docker no incluye Compose V2)

Gestor de múltiples contenedores coordinados.

------------------------------------------------------------------------

## 2. Clonación del Repositorio

Para obtener el código fuente del proyecto, ejecute el siguiente comando
en su terminal:

``` bash
git clone https://github.com/fergeo/trabajoPracticoIntegradorDevOps.git
```

Una vez descargado, ingrese al directorio del proyecto:

``` bash
cd trabajoPracticoIntegradorDevOps
```

------------------------------------------------------------------------

## 3. Estructura del Proyecto

El repositorio contiene archivos de configuración para construir y
ejecutar servicios dentro de contenedores Docker. Entre ellos:

-   **Dockerfile:** define cómo construir la imagen principal.\
-   **docker-compose.yml:** coordina los contenedores involucrados,
    exposición de puertos, volúmenes y dependencias.\
-   **src/**: código fuente del servicio o aplicación.\
-   **config/**: archivos de configuración necesarios para el
    funcionamiento del proyecto.

------------------------------------------------------------------------

## 4. Configuración Previa (Opcional)

Si el proyecto requiere variables de entorno, verifique si existe un
archivo:

-   `.env`
-   `.env.example`

En caso de existir un archivo de ejemplo, créelo de la siguiente manera:

``` bash
cp .env.example .env
```

Luego modifique los valores según las necesidades del entorno.

------------------------------------------------------------------------

## 5. Construcción y Ejecución del Proyecto con Docker Compose

El método recomendado para ejecutar el proyecto es mediante **Docker
Compose**, ya que automatiza la creación de imágenes, la inicialización
de servicios y la gestión de dependencias.

### \### 5.1 Construcción de contenedores

Ejecute el siguiente comando:

``` bash
docker compose build
```

Este proceso:

-   Compila las imágenes definidas en `docker-compose.yml`.
-   Descarga dependencias necesarias.
-   Configura el entorno según la definición del proyecto.

------------------------------------------------------------------------

### 5.2 Levantar el proyecto

Para iniciar los servicios definidos en el archivo de composición:

``` bash
docker compose up
```

Si desea reconstruir automáticamente ante cambios:

``` bash
docker compose up --build
```

------------------------------------------------------------------------

### 5.3 Ejecución en segundo plano (modo daemon)

``` bash
docker compose up -d
```

------------------------------------------------------------------------

## 6. Acceso a la Aplicación

Una vez levantados los contenedores, los servicios estarán disponibles
en la dirección:

    http://localhost:PUERTO

El puerto exacto depende de la configuración definida en
`docker-compose.yml`. En general puede consultar:

``` bash
docker ps
```

para ver qué puertos están mapeados.

------------------------------------------------------------------------

## 7. Visualización de Logs

Para inspeccionar la salida de los contenedores:

``` bash
docker compose logs -f
```

O para un servicio en particular:

``` bash
docker compose logs -f nombre_del_servicio
```

------------------------------------------------------------------------

## 8. Detener el Proyecto

Para finalizar la ejecución:

``` bash
docker compose down
```

Si desea eliminar volúmenes asociados:

``` bash
docker compose down --volumes
```

------------------------------------------------------------------------

## 9. Eliminación de Imágenes y Contenedores (Opcional)

En caso de necesitar reiniciar completamente el entorno:

``` bash
docker rm -f $(docker ps -aq)
docker rmi -f $(docker images -q)
```

**Advertencia:** esto eliminará todos los contenedores e imágenes en el
sistema.

------------------------------------------------------------------------

## 10. Conclusión

Mediante este procedimiento, el proyecto **Trabajo Práctico Integrador
DevOps** puede ejecutarse en un entorno controlado y estandarizado
utilizando Docker. Esta metodología garantiza una mayor portabilidad,
facilita el proceso de despliegue y asegura la consistencia operativa
entre distintos equipos de trabajo.

------------------------------------------------------------------------

## 11. Referencias

-   Documentación oficial de Docker: https://docs.docker.com/\
-   Documentación de Docker Compose: https://docs.docker.com/compose/\
-   Repositorio del proyecto:
    https://github.com/fergeo/trabajoPracticoIntegradorDevOps
