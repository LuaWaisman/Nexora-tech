# Nexora Tech

Sistema web de gestión de solicitudes de soporte técnico. Trabajo Práctico Integrador Individual de la materia Desarrollo de Sistemas Digitales (Colegio Del Carmen).

**Autora:** Lua Waisman – 5.º año, Informática.

## Descripción

Nexora Tech permite registrar problemas informáticos, consultarlos y administrar su estado. Tiene dos roles con permisos distintos:

- **Solicitante:** inicia sesión, crea solicitudes, consulta únicamente las suyas y ve su detalle y estado.
- **Técnico:** inicia sesión, ve todas las solicitudes, consulta su detalle y cambia su estado (Pendiente, En proceso o Resuelta).

Los permisos se verifican en el servidor con un middleware de roles.

## Tecnologías

- Laravel 13 y PHP 8.5
- MySQL / MariaDB
- Blade (plantillas), HTML y CSS propio
- Laragon (Apache + MySQL) como entorno local
- Composer

## Requisitos

- PHP 8.3 o superior
- Composer
- MySQL o MariaDB
- Git

## Instalación y ejecución

1. Clonar el repositorio y entrar en la carpeta:
   ```bash
   git clone https://github.com/LuaWaisman/Nexora-tech.git
   cd Nexora-tech
   ```
2. Instalar las dependencias:
   ```bash
   composer install
   ```
3. Crear el archivo de configuración y la clave de la aplicación:
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```
   (En Linux o macOS: `cp .env.example .env`).
4. Crear una base de datos vacía llamada `nexora_tech` en MySQL.
5. Importar el script `database/nexora_tech.sql` en esa base (por ejemplo, con HeidiSQL o phpMyAdmin). Crea las tablas y las cuentas de prueba.
6. Editar el archivo `.env` con los datos de la base de datos:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nexora_tech
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   Si la base no tiene la tabla `sessions` o `cache`, usar `SESSION_DRIVER=file` y `CACHE_STORE=file`.
7. Iniciar el servidor:
   ```bash
   php artisan serve
   ```
8. Abrir http://127.0.0.1:8000 en el navegador.

> Si PHP no está en el PATH de la terminal (por ejemplo, con Laragon), usar la ruta completa del ejecutable de PHP.

## Cuentas de prueba

Son cuentas creadas solo para desarrollo y evaluación.

| Rol | Correo | Contraseña |
|---|---|---|
| Solicitante | solicitante@nexora.com | 12345678 |
| Técnico | tecnico@nexora.com | 12345678 |

## Funcionalidades implementadas

- Inicio y cierre de sesión con validación de credenciales.
- Control de acceso por rol (solicitante y técnico) verificado en el servidor.
- Registro de solicitudes con validación; se asocian al usuario autenticado, con estado inicial Pendiente y fecha de creación.
- Listado de solicitudes con número, asunto, solicitante, fecha, tipo y estado, y buscador por asunto.
- El solicitante ve solo sus solicitudes; el técnico ve todas.
- Detalle de cada solicitud.
- Cambio de estado por parte del técnico, guardado en la base de datos.
- Panel de inicio con contadores por estado.
- Perfil con cambio de contraseña.

## Funciones no implementadas

Cambiar foto de perfil, adjuntar archivos a una solicitud y recuperación de contraseña por correo (la pantalla solo muestra un aviso).

## Estructura principal

- `routes/web.php`: rutas del sistema.
- `app/Http/Controllers/`: `AuthController`, `SolicitudController` y `PanelController`.
- `app/Http/Middleware/RoleMiddleware.php`: control de acceso por rol.
- `app/Models/`: `User` y `Solicitud`.
- `resources/views/`: vistas Blade.
- `public/css/app.css`: estilos.
- `database/nexora_tech.sql`: script para preparar la base de datos.
