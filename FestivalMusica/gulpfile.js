const { src, dest, watch, parallel } = require("gulp");

// CSS
const sass = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");

// Imagenes
const webp = require("gulp-webp");

function css(done) {
  src("src/scss/**/*.scss") // Identificar el archivo de SASS
    .pipe(plumber())
    .pipe(sass()) // Compilar el archivo de SASS
    .pipe(dest("build/css")); // Guardarlo en el HDD

  done(); // Callback que avisa a gulp que terminamos
}

function versionWebp(done) {
  const opciones = {
    quality: 50,
  };
  src("src/img/**/*.{png,jpg}").pipe(webp(opciones)).pipe(dest("build/img"));
  done();
}

function dev(done) {
  watch("src/scss/**/*.scss", css);
  done();
}

exports.css = css; // Exportar la función para que gulp la pueda ejecutar
exports.versionWebp = versionWebp;
exports.dev = parallel(versionWebp, dev);
