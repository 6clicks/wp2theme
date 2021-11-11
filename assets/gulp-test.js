// *****************************************************************************
// Publication automatique des fichiers modifiés. !Il faut avoir lancer la connection ftp.
gulp.task('ftp-deploy-watch', function () { // on donne un nom à la tâche "ftp-deploy-watch" ici.

    var conn = ftp.create({ // création de la variable "conn" utilisée pour la connection.
        host: gulpftp.config.host, // récupération de la variable "host" du fichier ftp-config.json
        port: gulpftp.config.port, // récupération de la variable "port" du fichier ftp-config.json
        user: gulpftp.config.user, // récupération de la variable "user" du fichier ftp-config.json
        password: gulpftp.config.pass, // récupération de la variable "pass" du fichier ftp-config.json

        parallel: 3 // nombre de connections en parallèle acceptées.
    });
    // création de la variable "globs" qui liste les fichiers à regarder et à uploader.
    var globs = [
        '**/*',
        '*',
        '!node_modules/**', // pour exclure des dossiers on les note avec un "!" au début. ici node_modules qui est trés volumineux
        '!ftp-conf.js' // ici notre fichier de configuration ftp. pour ne pas avoir nos infos visibles sur le serveur.
    ];

    gulp.watch(globs) // on lance le .watch pour garder à l'oeil les fichiers qui sont dans la variable "globs"
        .on('change', function (event) { // s'il y a un changement on lance la fonction.
            console.log('Changes detected! Uploading file "' + event.path + '", ' + event.type); // une notification dans la console pour avertir.

            return gulp.src([event.path], { base: '.', buffer: false })
                .pipe(conn.newer(gulpftp.config.dirdest)) // les nouveaux fichiers contenus dans le dossier "dirdest" configuré dans le ficher ftp-config.json.
                .pipe(conn.dest(gulpftp.config.dirdest))
                .pipe(plugins.notify({ message: 'Upload Done!' })); // une petite notification.

        });
});

////////////////////////////////////////////////////////////////////////

function deploy(key) {

    var conn = ftp.create({
        host: gulpftp.config.host, // récupération de la variable "host" du fichier ftp-config.json
        port: gulpftp.config.port, // récupération de la variable "port" du fichier ftp-config.json
        user: gulpftp.config.user, // récupération de la variable "user" du fichier ftp-config.json
        password: gulpftp.config.pass, // récupération de la variable "pass" du fichier ftp-config.json
        parallel: 10,
        maxConnections: 5,
        log: plugins.util.log
    });

    var globs = [

        '**/*',
        '*',
        '!node_modules/**', // pour exclure des dossiers on les note avec un "!" au début. ici node_modules qui est trés volumineux
        '!ftp-conf.js' // ici notre fichier de configuration ftp. pour ne pas avoir nos infos visibles sur le serveur.

    ];

    // using base = '.' will transfer everything to /public_html correctly
    // turn off buffering in gulp.src for best performance
    return gulp.src(globs, { base: path, buffer: false })
        .pipe(conn.newer(key)) // only upload newer files
        .pipe(conn.dest(key));


}

gulp.task('deploy-task', function (cb) {
    for (var key in deployPaths) {
        deployMultiple(key);
        cb();
    }

});

gulp.task('deploy', gulp.series('clean', 'git_export', 'deploy-task'));