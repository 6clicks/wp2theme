const { src, dest, parallel, series, watch } = require('gulp'); // enregister les différantes variables dépendante de gulp
var sass = require('gulp-sass')(require('sass'));
var uglify = require('gulp-uglify');
var notify = require("gulp-notify");
const cleanCSS = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');
var vftp = require('vinyl-ftp');
var gulpftpconf = require('./ftp-config.js'); // le fichier de configuration du FTP à ne pas oublier..
var chokidar = require('chokidar');



function scssCompile() {   // compiler le Scss et enregister dans le dossier CSS de Source! 
    return src('assets/sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            cascade: false
        }))
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
    watch("./assets/scss/**/*.scss", scssCompile);
};


function ftpUp(done) {


    var conn = vftp.create({ // création de la variable "conn" utilisée pour la connection.
        host: gulpftpconf.config.host, // récupération de la variable "host" du fichier ftp-config.json
        port: gulpftpconf.config.port, // récupération de la variable "port" du fichier ftp-config.json
        user: gulpftpconf.config.user, // récupération de la variable "user" du fichier ftp-config.json
        password: gulpftpconf.config.pass, // récupération de la variable "pass" du fichier ftp-config.json

        parallel: 1
    });

    // création de la variable "globs" qui liste les fichiers à regarder et à uploader.
    var globs = [
        '**/*',
        '*',
        '!node_modules/**', // pour exclure des dossiers on les note avec un "!" au début. ici node_modules qui est trés volumineux
        '!ftp-config.js'      // ici notre fichier de configuration ftp. pour ne pas avoir nos infos visibles sur le serveur.
    ];
    // Initialize watcher.
    const watcherFTP = chokidar.watch(globs, {
        ignored: /(^|[\/\\])\../, // ignore dotfiles
        persistent: true
    });

    watcherFTP.on('all', { ignoreInitial: false }, function (event, path) {
        console.log(event, path)
        return src(globs, { base: '.', buffer: false })
            .pipe(conn.newer(gulpftpconf.config.dirdest)) // les nouveaux fichiers contenus dans le dossier "dirdest" configuré dans le ficher ftp-config.json.
            .pipe(conn.dest(gulpftpconf.config.dirdest));
        //.pipe(notify(event, path + "Upoade  done!")); // petite popup pour validé que cest bon

    })

    done();

};//fin FTPUp




module.exports = {    // création des appèls pour lance les functions . 
    default: series(parallel(scssCompile), ftpUp, watchFiles), // compile le scss et le js et lance le watch pour surveillé les modifs
    ftp: series(parallel(scssCompile), ftpUp),
    prod: series(scssCompile, parallel(jsMin, cssToProd, imagesToProd)), // pour lancer le projet en prod ( compile le scss et ensuite lance ne parallèle les fonction js html css images)
    watch: watchFiles
};

