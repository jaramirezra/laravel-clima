# Laravel Clima — Docker (PHP 8.3 + Nginx + MySQL 8 + Vite)

Aplicación que consulta el clima actual de ciudades colombianas usando la API de OpenWeatherMap, con los datos de ciudades y coordenadas gestionados en MySQL.

## Estructura
```
laravel-clima/
├── docker-compose.yml
├── .env                    # variables de Docker (DB, UID/GID)
├── docker/
│   ├── php/Dockerfile       # PHP 8.3-FPM + Node.js 20 + Composer
│   └── nginx/default.conf
└── src/                     # proyecto Laravel 10
```

## Servicios del stack
- **app** — PHP 8.3-FPM + Node.js (para Vite)
- **webserver** — Nginx, sirve en `http://localhost:8000`
- **db** — MySQL 8, expuesto en `localhost:3306`
- **phpmyadmin** — `http://localhost:8080`

## Primer levantamiento del proyecto

```powershell
# 1. Construir la imagen de PHP
docker compose build app

# 2. Crear el proyecto Laravel 10 dentro de src/
cd src
docker run --rm -v ${PWD}:/var/www -w /var/www composer:2 create-project laravel/laravel:^10.0 .

# 3. Forzar plataforma PHP 8.3 (evita conflictos de versión al instalar)
docker run --rm -v ${PWD}:/var/www -w /var/www composer:2 config platform.php 8.3.32
docker run --rm -v ${PWD}:/var/www -w /var/www composer:2 update

cd ..
```

## Configurar variables de entorno

**`.env` raíz** (variables de Docker):
```env
UID=1000
GID=1000

DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
DB_ROOT_PASSWORD=rootsecret
```

**`src/.env`** (Laravel — debe apuntar al servicio `db`, no a `127.0.0.1`):
```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret

OPENWEATHER_API_KEY=tu_key_aqui
```

Registra la key en `src/config/services.php`:
```php
'openweather' => [
    'key' => env('OPENWEATHER_API_KEY'),
],
```

## Levantar el stack completo

```powershell
docker compose up -d --build

docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed --class=CitySeeder

docker compose exec -u root app chown -R appuser:appuser /var/www
```

App disponible en **http://localhost:8000**

## Vite (compilar CSS/JS)

```powershell
docker compose exec app npm install
docker compose exec app npm run dev      # modo desarrollo (watch, deja la terminal ocupada)
docker compose exec app npm run build    # compilación final para producción
```

Puerto 5173 debe estar expuesto en `docker-compose.yml` (servicio `app`):
```yaml
ports:
  - "5173:5173"
```

## Modelo de datos

**`cities`** — catálogo de ciudades colombianas
```
id, name (unique), created_at, updated_at
```

**`forms`** — coordenadas y datos asociados a una ciudad
```
id, city_id (FK → cities), latitude, longitudinal, image, created_at, updated_at
```

Relación: `City hasMany Form` / `Form belongsTo City`

## Rutas principales

| Método | Ruta | Descripción |
|---|---|---|
| GET | `/cities` | Lista de ciudades registradas |
| GET | `/cities/{city}/weather` | Consulta clima en vivo (JSON) usando lat/long del `form` más reciente de esa ciudad |
| GET/POST | `/forms` | CRUD de formularios (ciudad + coordenadas + imagen) |

## Comandos útiles

```powershell
# Artisan / Composer (siempre con el prefijo de Docker)
docker compose exec app php artisan tinker
docker compose exec app php artisan migrate:fresh --seed
docker compose exec app php artisan route:list
docker compose exec app php artisan route:clear
docker run --rm -v ${PWD}:/var/www -w /var/www composer:2 require nombre/paquete   # desde src/

# Permisos (si VS Code/Windows rompe el owner de algun archivo)
docker compose exec -u root app chown -R appuser:appuser /var/www

# Logs
docker compose logs -f app
docker compose exec app tail -f storage/logs/laravel.log

# Apagar
docker compose down          # apaga todo
docker compose down -v       # apaga y BORRA el volumen de MySQL (pierdes los datos)
```

## Notas
- El servicio `app` corre PHP-FPM; Nginx (`webserver`) es el que expone el puerto 8000 y pasa las peticiones `.php` a `app:9000`.
- Si `artisan` da error de permisos al crear archivos, usa `docker compose exec -u root app <comando>` o corre el `chown -R` de arriba.
- `migrate:fresh` borra y recrea todas las tablas — solo úsalo en desarrollo.
- La API key de OpenWeatherMap tarda hasta ~2 horas en activarse tras crearla; si da 401 al inicio, espera y reintenta.
- **Importante:** nunca subas tu `.env` con la API key real a un repositorio público; agrégalo a `.gitignore` (ya viene por defecto en Laravel).
