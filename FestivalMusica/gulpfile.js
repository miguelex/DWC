const { src, dest, watch } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");

function css(done) {
  src("src/scss/**/*.scss") // Identificar el archivo de SASS
    .pipe(plumber())
    .pipe(sass()) // Compilar el archivo de SASS
    .pipe(dest("build/css")); // Guardarlo en el HDD

  done(); // Callback que avisa a gulp que terminamos
}

function dev(done) {
  watch("src/scss/**/*.scss", css);
  done();
}
exports.css = css; // Exportar la función para que gulp la pueda ejecutar
exports.dev = dev;
