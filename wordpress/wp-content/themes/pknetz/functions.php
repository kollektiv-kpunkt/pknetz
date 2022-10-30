<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$Browser = new foroco\BrowserDetection();
$_ENV["BROWSER"] = $Browser->getBrowser($_SERVER['HTTP_USER_AGENT'])["browser_name"];

function pknetz_BrowserClass() {
    $browser = "pknetz-browser-" . strtolower(str_replace(" ", "-", $_ENV["BROWSER"]));
    return $browser;
}

/* pknetz */
global $scriptVersion;
if ($_ENV["DEV"] == 1) {
    $scriptVersion = microtime();
} else {
    $scriptVersion = wp_get_theme( )->get( 'Version' );
}

function pknetz_scripts() {
    global $scriptVersion;
    wp_enqueue_style( 'bundle', get_template_directory_uri() . '/dist/bundle.min.css', [], $scriptVersion );
    wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/app.min.js', array(), $scriptVersion, true );
}
add_action( 'wp_enqueue_scripts', 'pknetz_scripts' );

function pknetz_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'editor-styles' );
    add_editor_style('dist/bundle.min.css' );
}
add_action( 'after_setup_theme', 'pknetz_theme_support' );


function pkn_menus() {
  register_nav_menu('pkn-main-nav',__( 'Main Navigation' ));
  register_nav_menu('pkn-footer-nav',__( 'Footer Navigation' ));
  register_nav_menu('pkn-some-icons',__( 'Some Icons' ));
}
add_action( 'init', 'pkn_menus' );

function pkn_menu_items( $location, $args = [] ) {

    // Get all locations
    $locations = get_nav_menu_locations();

    // Get object id by location
    $object = wp_get_nav_menu_object( $locations[$location] );

    // Get menu items by menu name
    $menu_items = wp_get_nav_menu_items( $object->name, $args );

    // Return menu post objects
    return $menu_items;
}


// ACF

function pknetz_acf() {
    define( 'MY_ACF_PATH', get_stylesheet_directory() . '/lib/acf/' );
    define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/lib/acf/' );
    include_once( MY_ACF_PATH . 'acf.php' );
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url( $url ) {
        return MY_ACF_URL;
    }

    add_filter('acf/settings/save_json', 'set_acf_json_save_folder');
    function set_acf_json_save_folder( $path ) {
        $path = MY_ACF_PATH . '/acf-json';
        return $path;
    }
    add_filter('acf/settings/load_json', 'add_acf_json_load_folder');
    function add_acf_json_load_folder( $paths ) {
        unset($paths[0]);
        $paths[] = MY_ACF_PATH . '/acf-json';;
        return $paths;
    }

    acf_register_block_type(array(
        'name'              => 'frontpage-heroine',
        'title'             => __('Frontpage Heroine'),
        'description'       => __('Frontpage Heroine'),
        'render_template'   => 'template-parts/blocks/frontpage-heroine.php',
        'category'          => 'pknetz',
        'icon'              => '',
        'keywords'          => array("heroine", "frontpage"),
        'supports'          => array("anchor" => false)
    ));

    // (Optional) Hide the ACF admin menu item.
    // add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
    // function my_acf_settings_show_admin( $show_admin ) {
    //     return false;
    // }
}
pknetz_acf();

// HTAccess
function pkn_htaccess( $rules ) {
    $content = <<<EOD
    \n
    Options +FollowSymLinks -MultiViews
    RewriteEngine On
    RewriteBase /
    RewriteRule ^api/?$ /wp-content/themes/pknetz/api/index.php [L,NC]
    RewriteRule ^api/(.+)$ /wp-content/themes/pknetz/api/index.php [L,NC]\n\n
    EOD;
    return $content . $rules;
}
add_filter('mod_rewrite_rules', 'pkn_htaccess');
