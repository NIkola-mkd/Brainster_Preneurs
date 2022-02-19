const mix = require("laravel-mix");

mix.disableNotifications();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css")
    .postCss("resources/css/login.css", "public/css")
    .postCss("resources/css/custom.css", "public/css")
    .postCss("resources/css/register.css", "public/css")
    .postCss("resources/css/profile.css", "public/css")
    .postCss("resources/css/dashboard.css", "public/css")
    .postCss("resources/css/my-projects.css", "public/css")
    .postCss("resources/css/create_edit_projects.css", "public/css")
    .js("resources/js/textarea.js", "public/js")
    .js("resources/js/readMoreLess.js", "public/js")
    .js("resources/js/ajax.js", "public/js");
