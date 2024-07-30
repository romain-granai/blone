<?php
// // Définition du textdomain
	load_theme_textdomain( 'blone' );

// Gestion du <title> par WP
	add_theme_support( 'title-tag' );

// // Définition des ID de pages pour un accès plus facile

	// define('ID_HOME', 6);
	// define('ID_NEWS', 17);
	// define('ID_PORTFOLIO', 155);

function blone_unregister_tags() {
	unregister_taxonomy_for_object_type( 'post_tag', 'post' );
}
add_action( 'init', 'blone_unregister_tags' );




// ACF - Activation des Options Page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme options',
		'menu_title'	=> 'Theme options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

function prefix_reset_metabox_positions(){
	delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_post' );
	delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_page' );
	delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_custom_post_type' );
  }
  add_action( 'admin_init', 'prefix_reset_metabox_positions' );

function custom_mime_types($mimes) {
    // Allow SVG file upload
    $mimes['svg'] = 'image/svg+xml';
    // Allow GLTF file upload
    $mimes['gltf'] = 'model/gltf+json';
    $mimes['glb'] = 'model/gltf-binary';
	$mimes['obj'] = 'text/plain';
    return $mimes;
}
add_filter('upload_mimes', 'custom_mime_types');

// Fix MIME type check
function fix_gltf_mime_type_check($data, $file, $filename, $mimes) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext === 'gltf') {
        $data['type'] = 'model/gltf+json';
        $data['ext'] = 'gltf';
    } elseif ($ext === 'glb') {
        $data['type'] = 'model/gltf-binary';
        $data['ext'] = 'glb';
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'fix_gltf_mime_type_check', 10, 4);
