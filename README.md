# TaskFlow

TaskFlow es una aplicación web para la gestión personal de tareas,
desarrollada con Laravel y MySQL. Permite registrar actividades,
organizar prioridades y dar seguimiento al estado de cada tarea.

## Funcionalidades

- Registro de tareas.
- Edición y eliminación de tareas.
- Asignación de prioridades: baja, media y alta.
- Seguimiento de tareas pendientes, en progreso y completadas.
- Búsqueda de tareas por título.
- Filtros por estado y prioridad.
- Identificación de tareas vencidas.
- Panel principal con estadísticas.

## Tecnologías utilizadas

- PHP 8.2
- Laravel 12
- MySQL
- HTML5
- CSS3
- JavaScript
- Apache
- Git y GitHub

## Requisitos

- PHP compatible con Laravel 12 y sus extensiones requeridas.
- Composer.
- MySQL.
- Apache con soporte para archivos `.htaccess`.
- Git.

## Instalación

### 1. Obtener el proyecto

Clonar el repositorio o descargar el código fuente desde GitHub.

### 2. Instalar las dependencias

Desde la carpeta raíz del proyecto, ejecutar:

    composer install

### 3. Configurar las variables de entorno

Copiar el archivo `.env.example` y crear un archivo `.env`.

Configurar los datos de conexión a MySQL en el archivo `.env`:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=taskflow_db
    DB_USERNAME=root
    DB_PASSWORD=

Los valores anteriores corresponden a una configuración local de
referencia. Deben ajustarse al entorno donde se instale la aplicación.

### 4. Generar la clave de la aplicación

Ejecutar:

    php artisan key:generate

### 5. Crear la base de datos

Crear una base de datos MySQL llamada `taskflow_db`, o utilizar
el nombre configurado en el archivo `.env`.

### 6. Ejecutar las migraciones

Ejecutar:

    php artisan migrate

Este comando crea las tablas necesarias para la aplicación.

### 7. Configurar Apache

Configurar el Virtual Host para que el DocumentRoot apunte a la
carpeta `public` del proyecto.

Habilitar las reglas de reescritura necesarias y permitir que Apache
procese el archivo `.htaccess` de Laravel.

## Ejecución local

En el entorno de desarrollo configurado, la aplicación se encuentra
disponible en:

http://taskflow.local

## Control de versiones

El código fuente se administra mediante Git y se publica en GitHub.
Los cambios se registran mediante commits con mensajes descriptivos.

## Seguridad

El archivo `.env` contiene configuración local y no debe publicarse
en el repositorio.

Las carpetas `vendor` y `node_modules` se excluyen del control de
versiones cuando corresponde. Las dependencias pueden instalarse
nuevamente mediante las herramientas de gestión correspondientes.