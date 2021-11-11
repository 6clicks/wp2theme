const { src, dest, parallel, series, watch } = require('gulp'); // enregister les différantes variables dépendante de gulp
var sass = require('gulp-sass')(require('sass'));
var uglify = require('gulp-uglify');
var notify = require("gulp-notify");
const cleanCSS = require('gulp-clean-css');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
var gutil = require('gulp-util');
var ftp = require('vinyl-ftp');


function scssCompile() {   // compiler le Scss et enregister dans le dossier CSS de Source! 
    return src('assets/sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer, cssnano()]))
        .pipe(dest('assets/css'))
        .pipe(notify("SCSS done!")); // petite popup pour validé que cest bon

};


function jsMin(done) { // compress le js et l'enregiste dans la prod ... J'aurais pu l'appeler jsToProd

    return src('sources/js/*.js')
        .pipe(uglify())
        .pipe(dest('prod/js/')),
        done();

};

function cssToProd(done) {   // compress les css et le enregistre dans la prod
    return src('sources/css/*.css')
        .pipe(cleanCSS())
        .pipe(dest('prod/css/')),
        done();
};

function imagesToProd(done) { // déplace les image en prod.. Pas de compression pour l'instant
    return src('assets/images/*')
        .pipe(dest('prod/images/')),
        done();
};


// Watch files
function watchFiles() {  // surveille si le scss ou js est modifié et lance automatiquement la compliation si un changement est détécté
    watch("./assets/sass/**/*.scss", scssCompile);
}


module.exports = {    // création des appèls pour lance les functions . 
    default: series(parallel(scssCompile), watchFiles), // compile le scss et le js et lance le watch pour surveillé les modifs
    prod: series(scssCompile, parallel(jsMin, cssToProd, imagesToProd)), // pour lancer le projet en prod ( compile le scss et ensuite lance ne parallèle les fonction js html css images)
    watch: watchFiles
};

