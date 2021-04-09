const { src, dest, watch, series} = require('gulp');
const sass = require('gulp-sass');

sass.compiler = require('node-sass');

exports.sass = function () {
    return src('./src/styles/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(dest('./dist/styles'));
};

exports.sassWatch = function () {
    watch('./src/styles/main.scss', series('sass'));
};