# Apuntes Tailwind
## Extensión VSC recomendada
Tailwind CSS IntelliSense
## Instalación
https://tailwindcss.com/docs/installation

Ver instalación por framework/librerias. La instalación a continuación es la "básica".
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
## Colores
En este enlace aparecen los colores y cómo configurarlos:
https://tailwindcss.com/docs/customizing-colors

Para background se pueden utilizar clases del tipo: **bg-lime-500, bg-black**... 

Para texto: **text-bamber-500, text-white**...

Para añadir un color en concreto en hexadecimal (si no lo vas a querer reutilizar): **bg-[#C0FFEE], text-[#E66]**...

Se pueden definir colores en ```tailwind.config.js``` de la siguiente manera:
```
En tailwind.config.js:
...
  theme: {
    extend: {
      colors: {
        'mi-color': '#B17'
      }
    },
  },
...

En html:
...
<p class="bg-mi-color"> Color personalizado en tailwind.config.js</p>
...
```
## Margins, paddings, borders
### Padding
![](./app/imgs/padding.png)
Se pueden utilizar las siguientes clases:
- **p-5**: padding general.
- **pt-1, pr-2, pb-8, pl-3** (top, right, bottom, left).
- **px-8**: padding horizontal (left y right).
- **py-5**: padding vertical (top y bottom).

