# Sistema de Votaciones

Sistema de votaciones desarrollado con **Laravel 11** y **Vue 3**, utilizando **Vite** para la construcción, que permite la gestión de usuarios, preguntas y resultados con roles de **administrador** y **usuario**.

## Tecnologías

- PHP 8.2+
- Laravel 11
- Vue 3
- Vite
- Tailwind CSS
- Laravel Sanctum (Autenticación)
- Spatie Laravel Permission (Roles y permisos)
- MySQL

## Requisitos

- PHP 8.2+
- Composer
- Node.js 18+
- npm
- MySQL
- Git

## Instalación

Sigue los pasos a continuación para configurar y ejecutar el proyecto en tu entorno local.

1. Clona el repositorio y accede al directorio:
   ```bash
   git clone https://github.com/MateoArboleda06/sistema-votaciones.git
   cd sistema-votaciones

2. Instalar dependencias de PHP
   ```bash
   composer install
3. Instalar dependencias de Node.js
   ```bash
   npm install
4. Configurar el archivo .env
   
   Copia el archivo .env.example y renómbralo a .env:
   
        ```bash
        cp .env.example .env
   
   Edita el archivo .env y configura las siguientes variables según tu entorno:
   
    ```bash
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:GENERATED_KEY
    APP_DEBUG=true
    APP_URL=http://localhost
    
    LOG_CHANNEL=stack
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sistema_votaciones
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    
    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    
    SANCTUM_STATEFUL_DOMAINS=localhost:5173  

  **Nota:** Asegúrate de reemplazar tu_usuario y tu_contraseña con las credenciales de tu base de datos MySQL.
    
5. Generar la clave de la aplicación

   ```bash
   php artisan key:generate

6. Ejecutar migraciones y seeders

     ```bash
     php artisan migrate --seed

  Este comando creará las tablas necesarias en la base de datos y poblará datos iniciales, incluyendo roles y usuarios de prueba.
  Esto creara dos usuarios:
  
  **Administrador:**

  **User ** admin@example.com
  **Pass ** adminsecret

   **Residente:**

  **User ** 201@example.com
  **Pass ** secret201
  
7. Compilar los assets de frontend

     ```bash
     npm run dev
    
  Este comando iniciará Vite en modo de desarrollo y compilará los archivos de Vue y Tailwind CSS.
   
8. Iniciar el servidor de desarrollo

     ```bash
     php artisan serve

  La aplicación estará disponible en http://localhost:8000.

## Estructura del Proyecto

**app/:** Contiene la lógica del backend de Laravel.

**resources/js/:** Contiene los componentes de Vue y la lógica del frontend.

**resources/css/:** Contiene los estilos de Tailwind CSS.

**routes/:** Define las rutas de la aplicación.

**database/:** Contiene las migraciones y seeders de la base de datos.

## Autenticación y Roles

El proyecto utiliza Laravel Sanctum para la autenticación de usuarios y Spatie Laravel Permission para la gestión de roles y permisos. Los roles disponibles son:

**administrador:** Tiene acceso completo a la gestión de preguntas, resultados y votaciones.

**usuario:** Puede participar en las votaciones.

## Componentes Reutilizables

Se han creado componentes Vue reutilizables para mantener la consistencia en la interfaz de usuario:

**BaseInput.vue:** Componente para campos de entrada de texto.

**BaseButton.vue:** Componente para botones estilizados.

**CustomModal.vue:** Componente para modales personalizados.

Estos componentes se encuentran en **resources/js/components/.**
