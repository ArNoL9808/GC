const mix = require('laravel-mix');
const WebpackRTLPlugin = require('webpack-rtl-plugin');
const { VueLoaderPlugin } = require('vue-loader');
const lodash = require("lodash");

const folder = {
    src: "resources/", // Archivos fuente
    dist: "public/", // Archivos de construcción
    dist_assets: "public/assets/" // Archivos de activos de construcción
};

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix proporciona una API fluida y clara para definir algunos pasos de construcción de Webpack
 | para tu aplicación Laravel. Por defecto, estamos compilando el archivo Sass
 | para la aplicación, así como agrupando todos los archivos JS.
 |
 */

// Copiar todas las fuentes
mix.copyDirectory(folder.src + "fonts", folder.dist_assets + "fonts");

// Copiar todas las imágenes 
mix.copyDirectory(folder.src + "images", folder.dist_assets + "images");

// Copiar todos los archivos JS
mix.copyDirectory(folder.src + "js", folder.dist_assets + "js");

// Copiar todos los archivos de páginas JS
mix.copyDirectory(folder.src + "pages", folder.dist_assets + "pages");

// Copiar todos los plugins
mix.copyDirectory(folder.src + "plugins", "public/assets/plugins");

// Compilar los estilos Sass y minimizarlos
mix.sass('resources/scss/bootstrap.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/bootstrap.css");
mix.sass('resources/scss/bootstrap-material.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/bootstrap-material.css");
mix.sass('resources/scss/bootstrap-dark.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/bootstrap-dark.css");
mix.sass('resources/scss/icons.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/icons.css");
mix.sass('resources/scss/app.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/app.css");
mix.sass('resources/scss/app-material.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/app-material.css");
mix.sass('resources/scss/app-dark.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/app-dark.css");

// Configuración de Webpack
mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            }
        ]
    },
    plugins: [
        new WebpackRTLPlugin(),
        new VueLoaderPlugin()
    ],
    stats: {
        children: true,
    },
});

// Compilar el archivo app.js de Vue.js y agregarlo a public/js
mix.js('resources/js/app.js', 'public/js')
   .vue()
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('tailwindcss'),
       require('autoprefixer'),
   ]);
