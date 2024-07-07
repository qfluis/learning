## Filament
### Filament 2 (php 8 + laravel 10)
#### Instalación
Utilizaremos sqlite, por lo que si no está instalado en el sistema:
```
sudo apt-get install php-sqlite
```
Instalamos laravel:
```
composer create-project laravel/laravel:^10.0 filament2
cd filament2
php artisan storage:link
```
Configuramos BD, en .env añadimos las líneas:
```
DB_CONNECTION=sqlite
DB_DATABASE=/home/luis/Escritorio/LUIS/PROJECTS/learning/filament/filament2/database/db.sqlite
DB_FOREIGN_KEYS=true
```
Ejecutamos migraciones
```
php artisan migrate
```
Instalamos Filament 2 y creamos usuario
```
composer require filament/filament:"^2.0"
php artisan make:filament-user
```

#### Signature Pad
Componente para añadir a filament forms, casilla de firma.

https://github.com/savannabits/filament-signature-pad/tree/1.x#readme

```
composer require savannabits/filament-signature-pad
```

```
php artisan make:model Firma -m
composer require doctrine/dbal --dev
php artisan make:filament-resource Firma --generate
```