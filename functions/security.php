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