<?php
require __DIR__ . '/vendor/autoload.php';
use Ramsey\Uuid\Uuid;
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
    $scriptVersion = time();
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
    add_editor_style('wordpress/gutenberg-fixes.css' );
    add_post_type_support( 'page', 'excerpt' );
    add_post_type_support( 'post', 'excerpt' );
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

    acf_register_block_type(array(
        'name'              => 'frontpage-blogs',
        'title'             => __('Frontpage Blogs'),
        'description'       => __('Blogs on Frontpage'),
        'render_template'   => 'template-parts/blocks/frontpage-blogs.php',
        'category'          => 'pknetz',
        'icon'              => '',
        'keywords'          => array("blogs", "frontpage"),
        'supports'          => array('anchor' => true)
    ));

    acf_register_block_type(array(
        'name'              => 'frontpage-events',
        'title'             => __('Frontpage Events'),
        'description'       => __('Events on Frontpage'),
        'render_template'   => 'template-parts/blocks/frontpage-events.php',
        'category'          => 'pknetz',
        'icon'              => '',
        'keywords'          => array("events", "frontpage"),
        'supports'          => array('anchor' => true,)
    ));

    acf_register_block_type(array(
        'name'              => 'frontpage-actares',
        'title'             => __('Frontpage Actares'),
        'description'       => __('Actares recommendations on Frontpage'),
        'render_template'   => 'template-parts/blocks/frontpage-actares.php',
        'category'          => 'pknetz',
        'icon'              => '',
        'keywords'          => array("actares", "frontpage"),
        'supports'          => array('anchor' => true,)
    ));

    acf_register_block_type(array(
        'name'              => 'frontpage-newsletter',
        'title'             => __('Frontpage Newsletter'),
        'description'       => __('Newsletter Bar for Frontpage'),
        'render_template'   => 'template-parts/blocks/frontpage-newsletter.php',
        'category'          => 'pknetz',
        'icon'              => '',
        'keywords'          => array("newsletter", "frontpage"),
        'supports'          => array('anchor' => true,)
    ));

    acf_register_block_type(array(
        'name'              => 'link-toggle',
        'title'             => __('Link Toggle'),
        'description'       => __('Modern toggle with arrow and link'),
        'render_template'   => 'template-parts/blocks/link-toggle.php',
        'category'          => 'pkn',
        'icon'              => '',
        'keywords'          => array("link", "toggle", "arrow"),
        'supports'          => array( 'anchor' => true )
    ));

    acf_register_block_type(array(
        'name'              => 'article-list',
        'title'             => __('Article List'),
        'description'       => __('List of articles with image, excerpt and link'),
        'render_template'   => 'template-parts/blocks/article-list.php',
        'category'          => 'pkn',
        'icon'              => '',
        'keywords'          => array("article", "list", "image", "excerpt", "link"),
        'supports'          => array( 'anchor' => true )
    ));

    // (Optional) Hide the ACF admin menu item.
    // add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
    // function my_acf_settings_show_admin( $show_admin ) {
    //     return false;
    // }
}
pknetz_acf();

add_filter( 'render_block', 'pkn_wrap_blocks', 10, 2 );

function pkn_wrap_blocks( $block_content, $block ) {
    if (!is_front_page(  )) {
        return $block_content;
    }

    $skip = [
        "core/columns"
    ];
    if ( strpos($block["blockName"], "core/") !== false && !in_array($block["blockName"], $skip) ) {
        $block_content = "<div class='md-container mx-auto' data-block-name='{$block["blockName"]}'>" . $block_content . "</div>";
    }
    return $block_content;
}

// Widgets

function pkn_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer Widget',
		'id'            => 'footer_widget',
		'before_widget' => '<div class="pkn-footer-widget">',
		'after_widget'  => '</div>'
	) );

}
add_action( 'widgets_init', 'pkn_widgets_init' );

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

// Hooks

function pkn_set_event_hash($post_id, $post, $update) {
    if ( $post->post_type == 'tribe_events' && empty(get_post_meta($post_id, 'hash_set')) ) {
        $uuid = Uuid::uuid4();
        update_field('event_hash', $uuid->toString(), $post_id);
        update_post_meta( $post_id, 'hash_set', true );
    }
}
add_action( 'wp_insert_post', 'pkn_set_event_hash', 10, 3 );



// Shortcodes
function pkn_hidden_eventdetails_shortcode($atts, $content = null) {
    global $post;
    ob_start();
    if (isset($_GET["event_invitation"]) && $_GET["event_invitation"] == get_field('event_hash', $post->ID)) {
        return $content;
    }
    return ob_get_clean();
}

add_shortcode('pkn-events-details', 'pkn_hidden_eventdetails_shortcode');

function pkn_some_shortcode($atts, $content = null) {
    global $post;
    ob_start();
    get_template_part( "template-parts/elements/some-icons");
    return ob_get_clean();
}

add_shortcode('pkn-some-icons', 'pkn_some_shortcode');

/*=============================================
                BREADCRUMBS
=============================================*/
//  to include in functions.php
function the_breadcrumb($args = array())
{
    $args = wp_parse_args($args, array(
        "text-color" => "text-gray-400",
        "opacity" => "opacity-100"
    ));

    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = '<i data-feather="chevron-right" class="inline-flex h-4 w-4"></i>'; // delimiter between crumbs
    $home = '<i data-feather="home" class="inline-flex h-4 w-4"></i>'; // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb

    global $post;
    $homeLink = get_bloginfo('url');
    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) {
            echo(
                <<<EOD
                <div id='pkn-crumbs' class='ist-breadcrumbs {$args["text-color"]} {$args["opacity"]} uppercase'><a class="pkn-noline" href='{$homeLink}'>{$home}</a></div>
                EOD);
        }
    } else {
        echo(
            <<<EOD
            <div id='pkn-crumbs' class='ist-breadcrumbs {$args["text-color"]} {$args["opacity"]} uppercase'><a class="pkn-noline" href='{$homeLink}'>{$home}</a> {$delimiter}
            EOD);
        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
            }
            echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
        } elseif (is_search()) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
            echo '<a class="pkn-noline" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a class="pkn-noline" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<a class="pkn-noline" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo(
                    <<<EOD
                    <a class="pkn-noline" href="{$homeLink}/{$slug['slug']}/">{$post_type->labels->singular_name}</a>
                    EOD);
                if ($showCurrent == 1) {
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                }
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
                if ($showCurrent == 0) {
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                }
                echo $cats;
                if ($showCurrent == 1) {
                    echo $before . get_the_title() . $after;
                }
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
            echo '<a class="pkn-noline" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
            if ($showCurrent == 1) {
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            }
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1) {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_page() && $post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $permalink = get_permalink($page->ID);
                $title = get_the_title($page->ID);
                $breadcrumbs[] = <<<EOD
                <a class="pkn-noline" href="{$permalink}">{$title}</a>
                EOD;
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) {
                    echo ' ' . $delimiter . ' ';
                }
            }
            if ($showCurrent == 1) {
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            }
        } elseif (is_tag()) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . 'Error 404' . $after;
        }
        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo ' (';
            }
            echo __(' Seite') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo ')';
            }
        }
        echo '</div>';
    }
}
