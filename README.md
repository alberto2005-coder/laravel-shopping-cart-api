# Laravel Shopping Cart API 🛒

[Español](#español) | [English](#english)

---

## Español

Esta es la API para un sistema de carrito de compras construido con **Laravel 12.x** (con soporte de seguridad activo y vigente, tras el fin de soporte de seguridad de Laravel 11.x el 12 de marzo de 2026). Proporciona los endpoints necesarios para gestionar productos, usuarios y operaciones del carrito de compras.

### 📋 Requisitos Previos

Asegúrate de tener instalado en tu entorno local / servidor:
- [PHP](https://www.php.net/) (**>= 8.2 requerido**, compatible con PHP 8.2, 8.3, 8.4 y 8.5; PHP 8.2 cuenta con soporte de seguridad hasta el 31-12-2026).
  - Extensiones PHP requeridas: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `hash`, `json`, `mbstring`, `openssl`, `pdo`, `pdo_sqlite` (o `pdo_mysql`), `session`, `tokenizer`, `xml`, `zip`.
  - Verifica tu versión y extensiones activas con:
    ```bash
    php -v
    php -m
    ```
- [Composer](https://getcomposer.org/) (versión 2.2 o superior)
- [Node.js y npm](https://nodejs.org/) (para compilar assets del frontend si es necesario)
- Un gestor de base de datos (SQLite viene por defecto, pero puedes usar MySQL, PostgreSQL, etc.)

### 🚀 Instalación y Ejecución Local

Sigue estos pasos para levantar el entorno de desarrollo local:

1. **Clonar el repositorio** (si no lo has hecho ya):
   ```bash
   git clone <url-del-repositorio>
   cd laravel-shopping-cart-api
   ```

2. **Instalar dependencias de PHP**:
   ```bash
   composer install
   ```

3. **Instalar dependencias de Node.js**:
   ```bash
   npm install
   ```

4. **Configurar el archivo de entorno (`.env`)**:
   - Copia el archivo de ejemplo para crear tu configuración local:
     ```bash
     cp .env.example .env
     ```
   - Abre el archivo `.env` en tu editor de texto. Deberás configurar la conexión a la base de datos y otros servicios. A continuación se explica el propósito de las variables principales:

   #### Explicación de las variables en `.env`
   * **`APP_NAME`**: El nombre de tu aplicación.
   * **`APP_ENV`**: El entorno actual (usa `local` para desarrollo).
   * **`APP_KEY`**: Clave de encriptación. Se generará en el siguiente paso.
   * **`APP_DEBUG`**: Debe estar en `true` para ver los errores detallados mientras programas. En producción, cámbialo a `false`.
   * **`APP_URL`**: La URL base de tu proyecto (ej. `http://localhost:8000`).
   * **Configuración de Base de Datos (`DB_*`)**:
     * `DB_CONNECTION`: El motor de base de datos (ej. `sqlite`, `mysql`). El proyecto por defecto usa `sqlite`.
     * Si cambias a `mysql` u otro, deberás descomentar y rellenar `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` con los datos de tu servidor local (ej. XAMPP, Docker, etc.).
   * **Configuración de Correo (`MAIL_*`)**: Datos SMTP para envío de correos. En local, puedes usar `log` (no envía, lo guarda en archivo) o servicios como Mailtrap.

5. **Generar la clave de la aplicación**:
   ```bash
   php artisan key:generate
   ```

6. **Ejecutar las migraciones de la base de datos** (Crea las tablas):
   *(Si usas SQLite y el archivo no existe, te preguntará si deseas crearlo).*
   ```bash
   php artisan migrate
   ```

7. **Iniciar el servidor local**:
   ```bash
   php artisan serve
   ```
   Tu aplicación estará disponible en `http://localhost:8000`.

8. **(Opcional) Compilar assets frontend** (si el proyecto incluye Vite):
   Abre una nueva terminal y ejecuta:
   ```bash
   npm run dev
   ```

---

## English

This is the API for a shopping cart system built with **Laravel 12.x** (actively supported with current security maintenance, following the end-of-life of Laravel 11.x security updates on March 12, 2026). It provides the necessary endpoints to manage products, users, and shopping cart operations.

### 📋 Prerequisites

Make sure you have the following installed in your local environment / server:
- [PHP](https://www.php.net/) (**>= 8.2 required**, compatible with PHP 8.2, 8.3, 8.4, and 8.5; PHP 8.2 receives security support until 2026-12-31).
  - Required PHP extensions: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `hash`, `json`, `mbstring`, `openssl`, `pdo`, `pdo_sqlite` (or `pdo_mysql`), `session`, `tokenizer`, `xml`, `zip`.
  - Verify your active version and extensions with:
    ```bash
    php -v
    php -m
    ```
- [Composer](https://getcomposer.org/) (version 2.2 or higher)
- [Node.js & npm](https://nodejs.org/) (for compiling frontend assets if needed)
- A database manager (SQLite is default, but you can use MySQL, PostgreSQL, etc.)

### 🚀 Local Setup and Execution

Follow these steps to set up the local development environment:

1. **Clone the repository** (if you haven't already):
   ```bash
   git clone <repository-url>
   cd laravel-shopping-cart-api
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**:
   ```bash
   npm install
   ```

4. **Set up the environment file (`.env`)**:
   - Copy the example file to create your local configuration:
     ```bash
     cp .env.example .env
     ```
   - Open the `.env` file in your text editor. You will need to configure the database connection and other services. Below is an explanation of the main variables:

   #### Explanation of variables in `.env`
   * **`APP_NAME`**: The name of your application.
   * **`APP_ENV`**: The current environment (use `local` for development).
   * **`APP_KEY`**: Encryption key. It will be generated in the next step.
   * **`APP_DEBUG`**: Keep this as `true` to see detailed errors while developing. In production, change it to `false`.
   * **`APP_URL`**: The base URL of your project (e.g., `http://localhost:8000`).
   * **Database Configuration (`DB_*`)**:
     * `DB_CONNECTION`: The database engine (e.g., `sqlite`, `mysql`). The project defaults to `sqlite`.
     * If you change to `mysql` or another engine, you must uncomment and fill in `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` with your local server data (e.g., XAMPP, Docker, etc.).
   * **Mail Configuration (`MAIL_*`)**: SMTP data for sending emails. Locally, you can use `log` (does not send, saves to file) or services like Mailtrap.

5. **Generate the application key**:
   ```bash
   php artisan key:generate
   ```

6. **Run database migrations** (Creates the tables):
   *(If using SQLite and the file doesn't exist, it will prompt you to create it).*
   ```bash
   php artisan migrate
   ```

7. **Start the local server**:
   ```bash
   php artisan serve
   ```
   Your application will be mapped to `http://localhost:8000`.

8. **(Optional) Compile frontend assets** (if the project uses Vite):
   Open a new terminal and run:
   ```bash
   npm run dev
   ```
