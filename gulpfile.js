var gulp = require('gulp'),
    watch = require('gulp-watch'),
    prefixer = require('gulp-autoprefixer'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    rigger = require('gulp-rigger'),
    cssmin = require('gulp-minify-css'),
    imagemin = require('gulp-imagemin'),
    pngquant = require('imagemin-pngquant'),
    imageminJpegRecompress = require('imagemin-jpeg-recompress'),
    imageResize = require('gulp-image-resize'),
    critical = require('critical').stream,
    concat = require('gulp-concat'),
    jshint = require('gulp-jshint'),
    header = require('gulp-header'),
    rimraf = require('rimraf');

var path = {
    build: { //Тут мы укажем куда складывать готовые после сборки файлы
        html: '.',
        php: '.',
        js: 'js/',
        css: 'css/',
        img: 'news/',
        fonts: 'fonts/',
        resize: 'news/minify/'
    },
    src: { //Пути откуда брать исходники
        html: 'src/**/*.html',
        php: 'src/**/*.php',
        js: 'src/js/main.js',
        style: 'src/style/main.scss',
        img: 'src/news/**/*.jpg',
        fonts: 'src/fonts/**/*.*',
        resize: 'src/news/**/*.jpg'
    },
    watch: {
        html: 'src/**/*.html',
        php: 'src/**/*.php',
        js: 'src/js/main.js',
        style: 'src/style/main.scss'
    },
    clean: './'
};

var config = {
    server: {
        baseDir: "./project-graber.next"
    },
    tunnel: true,
    host: 'http://project-graber.next/',
    port: 9000,
    logPrefix: "project"
};

// gulp.task('critical', function () { //Выберем файлы по нужному пути
//     return gulp.src(path.src.test) //Выберем файлы по нужному пути
//         .pipe(critical({
//             base: 'news/',
//             inline: true,
//             minify: true,
//             css: [
//                 'css/main.css'
//             ]}))
//         .pipe(gulp.dest(path.build.test))
// });

gulp.task('html', function () {
    return gulp.src(path.src.html) //Выберем файлы по нужному пути
        .pipe(rigger()) //Прогоним через rigger
        .pipe(gulp.dest(path.build.html)) //Выплюнем их в папку build
});

gulp.task('php', function () {
    return gulp.src(path.src.php) //Выберем файлы по нужному пути
        .pipe(rigger()) //Прогоним через rigger
        .pipe(gulp.dest(path.build.php)) //Выплюнем их в папку build
});

gulp.task('js', function () {
    return gulp.src(path.src.js) //Найдем наш main файл
        .pipe(rigger()) //Прогоним через rigger
        .pipe(sourcemaps.init()) //Инициализируем sourcemap
        .pipe(uglify()) //Сожмем наш js
        .pipe(sourcemaps.write('/', {addComment: false})) //Пропишем карты
        .pipe(gulp.dest(path.build.js)) //Выплюнем готовый файл в build
});

gulp.task('style', function () {
    return gulp.src(path.src.style) //Выберем наш main.scss
        .pipe(sourcemaps.init()) //То же самое что и с js
        .pipe(sass()) //Скомпилируем
        .pipe(prefixer()) //Добавим вендорные префиксы
        .pipe(cssmin()) //Сожмем
        .pipe(sourcemaps.write('/', {addComment: false}))
        .pipe(gulp.dest(path.build.css)) //И в build
});

gulp.task('resize', function () {
    return gulp.src(path.src.resize) //Выберем наш main.scss
        .pipe(imageResize({
            width: 272,
            height: 153,
            crop: true,
            upscale: false,
            filter: 'Catrom',
            noProfile: true,
            interlace: true,
            imageMagick: true
        }))
        .pipe(gulp.dest(path.build.resize)) //И в build
});

gulp.task('image', function () {
    return gulp.src(path.src.img) //Выберем наши картинки
        .pipe(imagemin([
            imagemin.gifsicle(),
            imageminJpegRecompress({
                loops: 6,
                min: 50,
                max: 95,
                quality: 'high',
                progressive: true
            }),
            pngquant(),
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(gulp.dest(path.build.img)) //И бросим в build
});


gulp.task('fonts', function() {
    return gulp.src(path.src.fonts)
        .pipe(gulp.dest(path.build.fonts))
});

gulp.task('build', gulp.series('html','php','js','style','image','fonts'));

gulp.task('watch', function(){
    gulp.watch([path.watch.html], gulp.series('html'));
    gulp.watch([path.watch.php], gulp.series('php'));
    gulp.watch([path.watch.style], gulp.series('style'));
    gulp.watch([path.watch.js], gulp.series('js'));
});

gulp.task('watch:php', function(){
    gulp.watch([path.watch.php], gulp.series('php'));
});