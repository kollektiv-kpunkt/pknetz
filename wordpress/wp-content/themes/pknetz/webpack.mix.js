const mix = require("laravel-mix");
var LiveReloadPlugin = require("webpack-livereload-plugin");

mix.webpackConfig({
  plugins: [new LiveReloadPlugin()],
});

mix
  .setPublicPath("dist")
  .setResourceRoot("/wp-content/themes/oberbuesi/dist/")
  .js("src/js/app.js", "dist")
  .minify("dist/app.js", "dist/app.min.js")
  .sass("src/css/style.scss", "dist")
  .css("lib/font-awesome/css/font-awesome.min.css", "dist")
  .postCss("src/css/theme.css", "dist", [
    require("tailwindcss"),
    require("postcss-nested"),
  ])
  .combine(
    ["dist/theme.css", "dist/font-awesome.min.css", "dist/style.css"],
    "dist/bundle.css"
  )
  .minify("dist/bundle.css");
