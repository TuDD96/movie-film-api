const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//mix.js('resources/js/app.js', 'public/js')
//mix.sass('resources/sass/app.scss', 'public/css');

//**************** CSS ********************
//css
//mix.copy('resources/vendors/pace-progress/css/pace.min.css', 'public/css');
mix.copy(
    "node_modules/@coreui/chartjs/dist/css/coreui-chartjs.css",
    "public/css"
);
mix.copy("node_modules/cropperjs/dist/cropper.css", "public/css");
//main css
mix.sass("resources/sass/style.scss", "public/css");
mix.sass("resources/sass/app.scss", "public/css");
mix.sass("resources/sass/Portal/portal.scss", "public/css");
mix.sass("resources/sass/Client/client.scss", "public/css");
mix.sass("resources/sass/Client/mobile.scss", "public/css");
mix.copy("resources/sass/Portal/image-uploader.min.css", "public/css");
mix.copy("resources/sass/Adminer/css/default-blue.css", "public/css");
mix.copy("resources/sass/Adminer/css/default-green.css", "public/css");
mix.copy("resources/sass/Adminer/css/default-orange.css", "public/css");

//************** SCRIPTS ******************
// general scripts
mix.copy("node_modules/@coreui/utils/dist/coreui-utils.js", "public/js");
mix.copy("node_modules/axios/dist/axios.min.js", "public/js");
//mix.copy('node_modules/pace-progress/pace.min.js', 'public/js');
mix.copy(
    "node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js",
    "public/js"
);
// views scripts
mix.copy("node_modules/chart.js/dist/Chart.min.js", "public/js");
mix.copy(
    "node_modules/@coreui/chartjs/dist/js/coreui-chartjs.bundle.js",
    "public/js"
);

mix.copy("node_modules/cropperjs/dist/cropper.js", "public/js");
// details scripts
mix.copy("resources/js/coreui/main.js", "public/js");
mix.copy("resources/js/coreui/colors.js", "public/js");
mix.copy("resources/js/coreui/charts.js", "public/js");
mix.copy("resources/js/coreui/widgets.js", "public/js");
mix.copy("resources/js/coreui/popovers.js", "public/js");
mix.copy("resources/js/coreui/tooltips.js", "public/js");
// details scripts admin-panel
mix.js("resources/js/coreui/menu-create.js", "public/js");
mix.js("resources/js/coreui/menu-edit.js", "public/js");
mix.js("resources/js/coreui/media.js", "public/js");
mix.js("resources/js/coreui/media-cropp.js", "public/js");
mix.copy("node_modules/jquery/dist/jquery.min.js", "public/js");
mix.copy("resources/js/bootstrap.min.js", "public/js");
//*************** OTHER ******************
// mix.js('resources/js/portal/custom-validator.js', 'public/js');
mix.scripts(
    [
        "resources/js/portal/loading.js",
        "node_modules/toastr/build/toastr.min.js",
        "resources/js/portal/toast.js",
        "resources/js/portal/upload-image.js"
    ],
    "public/js/app.js"
);
mix.scripts(
    [
        "node_modules/jquery-validation/dist/jquery.validate.min.js",
        "node_modules/jquery-validation/dist/localization/messages_ja.js"
    ],
    "public/js/jquery.validate.min.js"
);
mix.scripts(
    [
        "node_modules/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js"
    ],
    "public/js/jquery.datetimepicker.js"
);
mix.scripts(
    [
        "node_modules/select2/dist/js/select2.min.js",
        "node_modules/select2/dist/js/i18n/ja.js"
    ],
    "public/js/live-search.js"
);
mix.js("resources/js/portal/table.js", "public/js");
mix.js("resources/js/portal/custom-validator.js", "public/js");
mix.js("resources/js/portal/detect-platform.js", "public/js");
mix.js("resources/js/portal/image-uploader.min.js", "public/js");
mix.js("resources/js/portal/custom-datetimepicker.js", "public/js");

//fonts
mix.copy("node_modules/@coreui/icons/fonts", "public/fonts");
mix.copy("resources/sass/Adminer/fonts", "public/fonts");
//icons
mix.copy("node_modules/@coreui/icons/css/free.min.css", "public/css");
mix.copy("node_modules/select2/dist/css/select2.min.css", "public/css");
mix.copy("node_modules/@coreui/icons/css/brand.min.css", "public/css");
mix.copy("node_modules/@coreui/icons/css/flag.min.css", "public/css");
mix.copy("node_modules/@coreui/icons/svg/flag", "public/svg/flag");

mix.copy("node_modules/@coreui/icons/sprites/", "public/icons/sprites");
//images
mix.copy("resources/assets", "public/assets");
mix.copy("resources/sass/Adminer/images", "public/images");

//event
mix.js("resources/js/portal/event/list.js", "public/js/portal/event/list.js");

//league
mix.js("resources/js/portal/league/list.js", "public/js/portal/league/list.js");
// video
mix.js("resources/js/portal/video/list.js", "public/js/portal/video/list.js");
//client
mix.js("resources/js/client/client.js", "public/js/client/client.js");
