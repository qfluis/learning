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
Para mostrar las firmas en la tabla, generamos una custom column
```
php artisan make:table-column signature

// En el código de la vista blade:
<div>
    <img width="150px" src="{{ $getState() }}" alt="">
</div>
```
#### Filament Google Maps
Componente para mostrar Google Maps en filament.

https://github.com/cheesegrits/filament-google-maps

Para el ejemplo se ha creado modelo, migración y resource tabla clientes + seeder.
Para ejecutar el Seeder:
```
php artisan db:seed --class=ClientesSeeder
```

Para instalar paquete (con filament 2 la versión 1 es la que funciona mejor):
```
composer require cheesegrits/filament-google-maps ^1.0
```
El siguiente comando te da el código que debes pegar en el modelo que contiene la información que quieres dibujar en el mapa (latitud, longitud)
```
php artisan filament-google-maps:model-code
```

En el .env deberemos incluir la API_KEY, podemos publicar configs por si nos interesa cambiar algo.
```
GOOGLE_MAPS_API_KEY=your_map_key_here
php artisan vendor:publish --tag="filament-google-maps-config"
```
No acaba de adaptarse a necesidades... Investigar...



