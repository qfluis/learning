# Apuntes Tailwind
## Instalación
https://tailwindcss.com/docs/installation
```
npm install -D tailwindcss
npx tailwindcss init
```
En el fichero ```tailwind.config.js``` hay que configurar las rutas a los ficheros "template" que utilizarán Tailwind.
```
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/**/*.{html,js}"],
  theme: {
    extend: {},
  },
  plugins: [],
}
```
En el fichero css principal añadir las directivas:
```
@tailwind base;
@tailwind components;
@tailwind utilities;
```
Iniciar build de Tailwind:
```
npx tailwindcss -i ./app/css/input.css -o ./app/css/output.css --watch
```
En el index.html o fichero correspondiente añadir enlace a al css construido:
```
<link href="./output.css" rel="stylesheet">
```

