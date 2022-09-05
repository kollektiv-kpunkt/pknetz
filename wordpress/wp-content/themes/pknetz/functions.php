<?php
// require __DIR__ . '/vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->safeLoad();

// $Browser = new foroco\BrowserDetection();
// $_ENV["BROWSER"] = $Browser->getBrowser($_SERVER['HTTP_USER_AGENT'])["browser_name"];

// function pknetz_BrowserClass() {
//     $browser = "pknetz-browser-" . strtolower(str_replace(" ", "-", $_ENV["BROWSER"]));
//     return $browser;
// }

// /* pknetz */
// function pknetz_scripts() {
//     wp_enqueue_style( 'bundle', get_template_directory_uri() . '/dist/bundle.min.css', [], "2.0.0" );
//     wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/app.min.js', array(), "2.0.0", true );
// }
// add_action( 'wp_enqueue_scripts', 'pknetz_scripts' );

// function pknetz_theme_support() {
//     add_theme_support( 'title-tag' );
//     add_theme_support( 'post-thumbnails' );
//     add_theme_support( 'editor-styles' );
//     add_editor_style('dist/bundle.min.css' );
// }
// add_action( 'after_setup_theme', 'pknetz_theme_support' );


// // ACF

// function pknetz_acf() {
//     define( 'MY_ACF_PATH', get_stylesheet_directory() . '/lib/acf/' );
//     define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/lib/acf/' );
//     include_once( MY_ACF_PATH . 'acf.php' );
//     add_filter('acf/settings/url', 'my_acf_settings_url');
//     function my_acf_settings_url( $url ) {
//         return MY_ACF_URL;
//     }

//     add_filter('acf/settings/save_json', 'set_acf_json_save_folder');
//     function set_acf_json_save_folder( $path ) {
//         $path = MY_ACF_PATH . '/acf-json';
//         return $path;
//     }
//     add_filter('acf/settings/load_json', 'add_acf_json_load_folder');
//     function add_acf_json_load_folder( $paths ) {
//         unset($paths[0]);
//         $paths[] = MY_ACF_PATH . '/acf-json';;
//         return $paths;
//     }

//     // (Optional) Hide the ACF admin menu item.
//     // add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
//     // function my_acf_settings_show_admin( $show_admin ) {
//     //     return false;
//     // }
// }
// pknetz_acf();

// // Custom blocks
// acf_register_block_type(array(
//     'name'              => 'hometitle',
//     'title'             => __('Homepage Title'),
//     'description'       => __('Title that snaps to fullwidth on the homepage.'),
//     'render_template'   => 'template-parts/blocks/hometitle.php',
//     'category'          => 'pknetz',
//     'icon'              => '',
//     'keywords'          => array("Title", "Homepage"),
// ));