<?php

// // Ajout du menu principal
	function blone_register_my_menu() {
		register_nav_menus( array(
			'main'	=> __( 'Main', 'blone' ),
			'tools'	=> __( 'Tools', 'blone' ),
			'footer'	=> __( 'Footer', 'blone' ),
			// 'decouvrir'	=> __( 'Menu footer Decouvrir', 'blone' )
		));

	}
	add_action( 'after_setup_theme', 'blone_register_my_menu' );

	// function wp_get_menu_array($current_menu) {

	// 	$array_menu = wp_get_nav_menu_items($current_menu);
	// 	$menu = array();
	// 	foreach ($array_menu as $m) {
	// 		if (empty($m->menu_item_parent)) {
	// 			$menu[$m->ID] = array();
	// 			$menu[$m->ID]['ID'] 		= 	$m->ID;
	// 			$menu[$m->ID]['title'] 		= 	$m->title;
	// 			$menu[$m->ID]['url'] 		= 	$m->url;
	// 			$menu[$m->ID]['children']	= 	array();
	// 		}
	// 	}
	// 	$submenu = array();
	// 	foreach ($array_menu as $m) {
	// 		if ($m->menu_item_parent) {
	// 			$submenu[$m->ID] = array();
	// 			$submenu[$m->ID]['ID'] 		= 	$m->ID;
	// 			$submenu[$m->ID]['title']	= 	$m->title;
	// 			$submenu[$m->ID]['url'] 	= 	$m->url;
	// 			$menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
	// 		}
	// 	}
	// 	return $menu;
		
	// }





