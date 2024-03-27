# Bienes Raíces (Versión MVC)

En la última fase de nuestro proyecto, vamos a realizar la migración desde el final de la versión de Bíenes Raíces (POO) a esta nueva versión que hace uso del paradigma MVC. Para ello deberemos realizar los siguientes pasos:

1) Copiamos la carpeta classes del proyecto anterior y la renombramos como models.

2) Copiamos los ficheros ```composer.json```, ```composer.lock```, ```package.json```, ```package-loc.json``` y ```gulpfile.js```

3) Ejecutamos los comandos

> composer install

y

> npm i

4) Copiamos la carpeta  includes

5) Creamos las carpetas controllers, views y public

6) Editamos el fichero  ```composer.json``` para añadir lo siguiente (borrando lo existente)

```
"psr-4": {
            "Model\\": "./models",
            "MVC\\": "./",
            "Controllers\\": "./controllers"
        }
```

7) Editamos ```gulpfile.js``` para añadir ./public/ emn todas las rutas que encontremos

8) Ejectuamos ```npm run dev ``` para generar los css y js

9) Por último, en public, creamos un fichero ```index.php``` en blanco. 

A partir de esta estructura, se puede empezar el curso 

