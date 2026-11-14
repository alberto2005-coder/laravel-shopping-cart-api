# Laravel Shopping Cart API

[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![SQLite](https://img.shields.io/badge/SQLite-por%20defecto-003B57?logo=sqlite&logoColor=white)](https://sqlite.org/)
[![MIT](https://img.shields.io/badge/Licencia-MIT-green)](LICENSE)

[Español](#español) · [English](#english)

---

## Español

### Índice

- [Descripción](#descripción)
- [Características](#características)
- [Stack tecnológico](#stack-tecnológico)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Rutas de la aplicación](#rutas-de-la-aplicación)
- [Modelo de datos](#modelo-de-datos)
- [Datos de ejemplo](#datos-de-ejemplo)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Pruebas](#pruebas)
- [Seguridad y límites](#seguridad-y-límites)
- [Licencia](#licencia)

### Descripción

Aplicación de carrito de compras construida con **Laravel 12** y **Blade**. Incluye catálogo de artículos, registro e inicio de sesión, carrito por usuario y un CRUD completo de productos.

> [!NOTE]
> Aunque el repositorio se llama *API*, la implementación actual es una **aplicación web con vistas Blade**: no hay `routes/api.php` ni respuestas JSON. Todas las rutas devuelven HTML.

### Características

- **Catálogo**: muestra solo los artículos con stock mayor que cero.
- **Autenticación por sesión**: registro, login y logout con contraseñas hasheadas y protección CSRF.
- **Carrito por usuario**: añadir artículos, incrementar cantidades, eliminar líneas y calcular el total.
- **CRUD de artículos**: listado, alta, detalle, edición y borrado con validación de nombre, precio y stock.
- **Perfil de cliente**: se crea automáticamente al registrarse, junto con el carrito.
- **Datos de ejemplo**: seeder con usuario, artículos, carrito y una venta simulada.
- **Frontend**: Blade, Tailwind CSS y Vite.

### Stack tecnológico

| Capa | Tecnología |
|---|---|
| Lenguaje | PHP 8.2+ |
| Framework | Laravel 12.x |
| Vistas | Blade |
| Base de datos | SQLite por defecto; MySQL/PostgreSQL compatibles |
| Estilos | Tailwind CSS 3 |
| Assets | Vite 6 |
| Pruebas | PHPUnit 11 |

### Requisitos

- [PHP](https://www.php.net/) **8.2 o superior** (probado con 8.2–8.5).
- Extensiones PHP: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `hash`, `json`, `mbstring`, `openssl`, `pdo`, `pdo_sqlite` (o `pdo_mysql`), `session`, `tokenizer`, `xml`, `zip`.
- [Composer](https://getcomposer.org/) 2.2 o superior.
- [Node.js](https://nodejs.org/) 18 o superior y npm (solo para compilar los assets).
- Un gestor de base de datos: SQLite viene por defecto.

Comprueba tu entorno con:

```bash
php -v
php -m
composer --version
node --version
```

### Instalación

1. **Clona el repositorio**:

   ```bash
   git clone https://github.com/alberto2005-coder/laravel-shopping-cart-api.git
   cd laravel-shopping-cart-api
   ```

2. **Instala las dependencias de PHP**:

   ```bash
   composer install
   ```

3. **Instala las dependencias de Node.js**:

   ```bash
   npm install
   ```

4. **Crea el archivo de entorno**:

   ```bash
   cp .env.example .env    # Linux / macOS
   copy .env.example .env  # Windows
   ```

5. **Genera la clave de la aplicación**:

   ```bash
   php artisan key:generate
   ```

6. **Ejecuta las migraciones**:

   ```bash
   php artisan migrate
   ```

   Si usas SQLite y el archivo `database/database.sqlite` no existe, Laravel te preguntará si quieres crearlo.

7. **Carga los datos de ejemplo** *(opcional)*:

   ```bash
   php artisan db:seed
   ```

8. **Arranca el servidor**:

   ```bash
   php artisan serve
   ```

   La aplicación queda en `http://localhost:8000`.

9. **Compila los assets** *(opcional en desarrollo)*:

   ```bash
   npm run dev     # servidor de Vite con recarga
   npm run build   # build de producción
   ```

También puedes levantar servidor, cola y Vite a la vez con:

```bash
composer run dev
```

### Configuración

Las variables principales de `.env` son:

| Variable | Uso |
|---|---|
| `APP_NAME` | Nombre de la aplicación |
| `APP_ENV` | Entorno (`local` en desarrollo, `production` en producción) |
| `APP_KEY` | Clave de cifrado; se genera con `php artisan key:generate` |
| `APP_DEBUG` | `true` en desarrollo, **`false` en producción** |
| `APP_URL` | URL base, por ejemplo `http://localhost:8000` |
| `DB_CONNECTION` | Motor de base de datos (`sqlite` por defecto) |
| `DB_DATABASE` | Ruta del archivo SQLite o nombre de la base de datos |
| `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD` | Conexión para MySQL/PostgreSQL |
| `SESSION_DRIVER` | `database` por defecto; requiere las migraciones |
| `MAIL_MAILER` | `log` en local; SMTP o Mailtrap si necesitas correo real |

Para usar MySQL, cambia `DB_CONNECTION=mysql` y rellena las variables `DB_*`. Después ejecuta de nuevo `php artisan migrate`.

### Rutas de la aplicación

| Método | Ruta | Acción | Autenticación |
|---|---|---|---|
| `GET` | `/` | Redirige a `/tienda` | No |
| `GET` | `/tienda` | Catálogo de artículos con stock | No |
| `GET` | `/login` | Formulario de inicio de sesión | No |
| `POST` | `/login` | Valida credenciales | No |
| `GET` | `/register` | Formulario de registro | No |
| `POST` | `/register` | Crea usuario, cliente y carrito | No |
| `POST` | `/logout` | Cierra la sesión | Sí |
| `GET` | `/carrito` | Carrito y total | Sí |
| `POST` | `/carrito/add/{articulo}` | Añade una unidad | Sí |
| `DELETE` | `/carrito/remove/{articulo}` | Elimina la línea del carrito | Sí |
| `GET` | `/articulos` | Lista de artículos | **No** |
| `GET` | `/articulos/create` | Formulario de alta | **No** |
| `POST` | `/articulos` | Crea un artículo | **No** |
| `GET` | `/articulos/{articulo}` | Detalle del artículo | **No** |
| `GET` | `/articulos/{articulo}/edit` | Formulario de edición | **No** |
| `PUT/PATCH` | `/articulos/{articulo}` | Actualiza el artículo | **No** |
| `DELETE` | `/articulos/{articulo}` | Borra el artículo | **No** |

El CRUD de `/articulos` **no** está protegido por el middleware `auth`. Si publicas la aplicación, añade autenticación y autorización antes de exponer esas rutas.

### Modelo de datos

| Tabla | Campos principales | Relación |
|---|---|---|
| `users` | `name`, `email`, `password` | Un usuario tiene un carrito y un cliente |
| `clientes` | `user_id`, `telefono`, `direccion` | Pertenece a un usuario |
| `articulos` | `nombre`, `descripcion`, `precio`, `stock` | Pertenece a muchos carritos y ventas |
| `carritos` | `user_id` | Pertenece a un usuario |
| `articulo_carrito` | `carrito_id`, `articulo_id`, `cantidad` | Tabla pivote del carrito |
| `ventas` | `user_id`, `total`, `fecha`, `estado` | Pertenece a un usuario |
| `articulo_venta` | `venta_id`, `articulo_id`, `cantidad`, `precio` | Tabla pivote de la venta |

Las tablas `ventas` y `articulo_venta` están creadas y el seeder inserta una venta de ejemplo, pero **no existe un flujo de checkout** que las genere desde la interfaz.

### Datos de ejemplo

`php artisan db:seed` crea:

- Usuario **`test@example.com`** con contraseña **`password`**.
- Cliente con teléfono y dirección ficticios.
- Dos artículos: *Laptop Gamer* (1.500 €, 10 unidades) y *Mouse Inalámbrico* (25,50 €, 50 unidades).
- Un carrito con ambos artículos.
- Una venta simulada de 1.551 €.

> [!WARNING]
> Cambia o elimina el usuario de ejemplo antes de desplegar en producción. Las credenciales son públicas y forman parte del seeder.

### Estructura del proyecto

```text
laravel-shopping-cart-api/
├── app/
│   ├── Http/Controllers/
│   │   ├── ArticuloController.php  # CRUD de artículos
│   │   ├── AuthController.php      # Registro, login y logout
│   │   ├── CarritoController.php   # Carrito y total
│   │   └── TiendaController.php    # Catálogo
│   └── Models/
│       ├── Articulo.php
│       ├── Carrito.php
│       ├── Cliente.php
│       ├── User.php
│       └── Venta.php
├── database/
│   ├── migrations/                 # Esquema de tablas
│   └── seeders/DatabaseSeeder.php  # Datos de ejemplo
├── resources/
│   ├── css/app.css
│   ├── js/                         # Bootstrap de Vite
│   └── views/                      # Blade: tienda, carrito, artículos, auth
├── routes/web.php                  # Todas las rutas
├── public/                         # Punto de entrada
├── tests/                          # PHPUnit
├── composer.json
├── package.json
├── vite.config.js
├── .env.example
├── LICENSE
└── README.md
```

### Pruebas

```bash
php artisan test
# o
./vendor/bin/phpunit
```

La suite incluida es la de ejemplo de Laravel (`tests/Feature/ExampleTest.php` y `tests/Unit/ExampleTest.php`). **No cubre** el carrito, el CRUD ni la autenticación; si amplías el proyecto, añade pruebas de esas rutas.

### Seguridad y límites

- **No es una API JSON**: no hay rutas en `routes/api.php` ni controladores que devuelvan JSON.
- **CRUD sin autenticación**: cualquier visitante puede crear, editar o borrar artículos. Añade `middleware('auth')`, políticas o un panel de administración antes de publicarlo.
- **Stock no descontado**: al añadir al carrito se comprueba que haya stock, pero no se resta; tampoco hay checkout que lo descuente.
- **Sin ventas reales**: la tabla `ventas` y su modelo existen, pero no hay ruta ni controlador que registre una compra.
- **Eliminar borra la línea completa**: `/carrito/remove/{articulo}` quita el artículo entero, no una unidad.
- **Seeder con credenciales públicas**: `test@example.com` / `password`; cámbialo en producción.
- **`APP_DEBUG=true`** en `.env.example`: ponlo en `false` al desplegar.
- **Sin pruebas de negocio**: la suite incluida solo valida que Laravel arranca.

### Licencia

**MIT** — consulta [LICENSE](LICENSE). Puedes usar, copiar, modificar y distribuir el código, también comercialmente, conservando el aviso de copyright. © 2026 Alberto Ortiz.

---

## English

### Table of contents

- [Overview](#overview)
- [Features](#features)
- [Tech stack](#tech-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Application routes](#application-routes)
- [Data model](#data-model)
- [Sample data](#sample-data)
- [Project structure](#project-structure)
- [Tests](#tests)
- [Security and limits](#security-and-limits)
- [License](#license)

### Overview

A shopping cart application built with **Laravel 12** and **Blade**. It includes a product catalogue, registration and login, a per-user cart and a full product CRUD.

> [!NOTE]
> Although the repository is called an *API*, the current implementation is a **Blade web application**: there is no `routes/api.php` and no JSON responses. Every route returns HTML.

### Features

- **Catalogue**: only shows products with stock greater than zero.
- **Session authentication**: registration, login and logout with hashed passwords and CSRF protection.
- **Per-user cart**: add products, increase quantities, remove lines and calculate the total.
- **Product CRUD**: list, create, show, edit and delete with name, price and stock validation.
- **Customer profile**: created automatically on registration, together with the cart.
- **Sample data**: seeder with a user, products, a cart and a simulated sale.
- **Frontend**: Blade, Tailwind CSS and Vite.

### Tech stack

| Layer | Technology |
|---|---|
| Language | PHP 8.2+ |
| Framework | Laravel 12.x |
| Views | Blade |
| Database | SQLite by default; MySQL/PostgreSQL compatible |
| Styling | Tailwind CSS 3 |
| Assets | Vite 6 |
| Tests | PHPUnit 11 |

### Requirements

- [PHP](https://www.php.net/) **8.2 or later** (tested with 8.2–8.5).
- PHP extensions: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `hash`, `json`, `mbstring`, `openssl`, `pdo`, `pdo_sqlite` (or `pdo_mysql`), `session`, `tokenizer`, `xml`, `zip`.
- [Composer](https://getcomposer.org/) 2.2 or later.
- [Node.js](https://nodejs.org/) 18 or later and npm (only to build the assets).
- A database manager: SQLite is the default.

Check your environment with:

```bash
php -v
php -m
composer --version
node --version
```

### Installation

1. **Clone the repository**:

   ```bash
   git clone https://github.com/alberto2005-coder/laravel-shopping-cart-api.git
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

4. **Create the environment file**:

   ```bash
   cp .env.example .env    # Linux / macOS
   copy .env.example .env  # Windows
   ```

5. **Generate the application key**:

   ```bash
   php artisan key:generate
   ```

6. **Run the migrations**:

   ```bash
   php artisan migrate
   ```

   If you use SQLite and `database/database.sqlite` does not exist, Laravel will offer to create it.

7. **Load the sample data** *(optional)*:

   ```bash
   php artisan db:seed
   ```

8. **Start the server**:

   ```bash
   php artisan serve
   ```

   The application is served at `http://localhost:8000`.

9. **Build the assets** *(optional in development)*:

   ```bash
   npm run dev     # Vite dev server with hot reload
   npm run build   # production build
   ```

You can also start the server, the queue and Vite together:

```bash
composer run dev
```

### Configuration

The main `.env` variables are:

| Variable | Purpose |
|---|---|
| `APP_NAME` | Application name |
| `APP_ENV` | Environment (`local` in development, `production` in production) |
| `APP_KEY` | Encryption key; generated by `php artisan key:generate` |
| `APP_DEBUG` | `true` in development, **`false` in production** |
| `APP_URL` | Base URL, for example `http://localhost:8000` |
| `DB_CONNECTION` | Database engine (`sqlite` by default) |
| `DB_DATABASE` | SQLite file path or database name |
| `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD` | MySQL/PostgreSQL connection |
| `SESSION_DRIVER` | `database` by default; requires migrations |
| `MAIL_MAILER` | `log` locally; SMTP or Mailtrap for real email |

To use MySQL, set `DB_CONNECTION=mysql` and fill in the `DB_*` variables. Then run `php artisan migrate` again.

### Application routes

| Method | Route | Action | Authentication |
|---|---|---|---|
| `GET` | `/` | Redirects to `/tienda` | No |
| `GET` | `/tienda` | Catalogue of products in stock | No |
| `GET` | `/login` | Login form | No |
| `POST` | `/login` | Validates credentials | No |
| `GET` | `/register` | Registration form | No |
| `POST` | `/register` | Creates user, customer and cart | No |
| `POST` | `/logout` | Closes the session | Yes |
| `GET` | `/carrito` | Cart and total | Yes |
| `POST` | `/carrito/add/{articulo}` | Adds one unit | Yes |
| `DELETE` | `/carrito/remove/{articulo}` | Removes the cart line | Yes |
| `GET` | `/articulos` | Product list | **No** |
| `GET` | `/articulos/create` | Create form | **No** |
| `POST` | `/articulos` | Creates a product | **No** |
| `GET` | `/articulos/{articulo}` | Product detail | **No** |
| `GET` | `/articulos/{articulo}/edit` | Edit form | **No** |
| `PUT/PATCH` | `/articulos/{articulo}` | Updates the product | **No** |
| `DELETE` | `/articulos/{articulo}` | Deletes the product | **No** |

The `/articulos` CRUD is **not** protected by the `auth` middleware. If you deploy the application, add authentication and authorisation before exposing those routes.

### Data model

| Table | Main fields | Relationship |
|---|---|---|
| `users` | `name`, `email`, `password` | A user has one cart and one customer profile |
| `clientes` | `user_id`, `telefono`, `direccion` | Belongs to a user |
| `articulos` | `nombre`, `descripcion`, `precio`, `stock` | Belongs to many carts and sales |
| `carritos` | `user_id` | Belongs to a user |
| `articulo_carrito` | `carrito_id`, `articulo_id`, `cantidad` | Cart pivot table |
| `ventas` | `user_id`, `total`, `fecha`, `estado` | Belongs to a user |
| `articulo_venta` | `venta_id`, `articulo_id`, `cantidad`, `precio` | Sale pivot table |

The `ventas` and `articulo_venta` tables exist and the seeder inserts a sample sale, but there is **no checkout flow** that creates them from the UI.

### Sample data

`php artisan db:seed` creates:

- User **`test@example.com`** with password **`password`**.
- A customer profile with fictional phone and address.
- Two products: *Laptop Gamer* (€1,500, 10 units) and *Mouse Inalámbrico* (€25.50, 50 units).
- A cart with both products.
- A simulated sale of €1,551.

> [!WARNING]
> Change or remove the sample user before deploying to production. The credentials are public and part of the seeder.

### Project structure

```text
laravel-shopping-cart-api/
├── app/
│   ├── Http/Controllers/
│   │   ├── ArticuloController.php  # Product CRUD
│   │   ├── AuthController.php      # Registration, login and logout
│   │   ├── CarritoController.php   # Cart and total
│   │   └── TiendaController.php    # Catalogue
│   └── Models/
│       ├── Articulo.php
│       ├── Carrito.php
│       ├── Cliente.php
│       ├── User.php
│       └── Venta.php
├── database/
│   ├── migrations/                 # Table schema
│   └── seeders/DatabaseSeeder.php  # Sample data
├── resources/
│   ├── css/app.css
│   ├── js/                         # Vite bootstrap
│   └── views/                      # Blade: shop, cart, products, auth
├── routes/web.php                  # All routes
├── public/                         # Entry point
├── tests/                          # PHPUnit
├── composer.json
├── package.json
├── vite.config.js
├── .env.example
├── LICENSE
└── README.md
```

### Tests

```bash
php artisan test
# or
./vendor/bin/phpunit
```

The included suite is Laravel's example suite (`tests/Feature/ExampleTest.php` and `tests/Unit/ExampleTest.php`). It does **not** cover the cart, the CRUD or authentication; add tests for those routes if you extend the project.

### Security and limits

- **Not a JSON API**: there are no routes in `routes/api.php` and no controllers returning JSON.
- **Unauthenticated CRUD**: any visitor can create, edit or delete products. Add `middleware('auth')`, policies or an admin panel before going public.
- **Stock is not decremented**: adding to the cart checks availability but does not subtract it; there is no checkout to do so.
- **No real sales**: the `ventas` table and model exist, but no route or controller records a purchase.
- **Removing deletes the whole line**: `/carrito/remove/{articulo}` removes the entire product line, not a single unit.
- **Public sample credentials**: `test@example.com` / `password`; change them in production.
- **`APP_DEBUG=true`** in `.env.example`: set it to `false` when deploying.
- **No business tests**: the included suite only checks that Laravel boots.

### License

**MIT** — see [LICENSE](LICENSE). You may use, copy, modify and distribute the code, including commercially, as long as you keep the copyright notice. © 2026 Alberto Ortiz.
