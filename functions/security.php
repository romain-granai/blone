<?php

// N'affiche plus la différence entre erreur de login et erreur de mot de passe
	// add_filter('login_errors', create_function('$no_login_error', "return 'Données incorrectes';"));
	add_filter('login_errors', function($no_login_error) {return 'Données incorrectes';});

// Supprime le numéro de version de Wordpress généré automatiquement
	remove_action('wp_head', 'wp_generator');

// Supprime les emojis
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

// Désactive Windows Live Writer
	remove_action('wp_head', 'wlwmanifest_link');

// Disable REST API
	// remove_action( 'init',          'rest_api_init' );
	// remove_action( 'parse_request', 'rest_api_loaded' );

	// remove_action( 'xmlrpc_rsd_apis',            'rest_output_rsd' );
	// remove_action( 'wp_head',                    'rest_output_link_wp_head' );
	// remove_action( 'template_redirect',          'rest_output_link_header', 11 );
	// remove_action( 'auth_cookie_malformed',      'rest_cookie_collect_status' );
	// remove_action( 'auth_cookie_expired',        'rest_cookie_collect_status' );
	// remove_action( 'auth_cookie_bad_username',   'rest_cookie_collect_status' );
	// remove_action( 'auth_cookie_bad_hash',       'rest_cookie_collect_status' );
	// remove_action( 'auth_cookie_valid',          'rest_cookie_collect_status' );

	// add_filter( 'rest_enabled',       '__return_false' );
	// add_filter( 'rest_jsonp_enabled', '__return_false' );

// Disable XML RPC
	add_filter( 'xmlrpc_enabled', '__return_false' );
	remove_action( 'wp_head', 'rsd_link' );

	// Disable support for comments and trackbacks in post types
function blone_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'blone_disable_comments_post_types_support');

// Close comments on the front-end
function blone_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'blone_disable_comments_status', 20, 2);
add_filter('pings_open', 'blone_disable_comments_status', 20, 2);

// Hide existing comments
function blone_disable_comments_hide_existing($comments) {
    return [];
}
add_filter('comments_array', 'blone_disable_comments_hide_existing', 10, 2);

// Remove comments page in menu
function blone_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'blone_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function blone_disable_comments_admin_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'blone_disable_comments_admin_redirect');

// Remove comments metabox from dashboard
function blone_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'blone_disable_comments_dashboard');

// Remove comment links from admin bar
function blone_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'blone_disable_comments_admin_bar');