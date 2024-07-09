<?php

// Register Custom Post Type
function create_families_post_type() {

    $labels = array(
        'name'                  => _x( 'Families', 'Post Type General Name', 'blone' ),
        'singular_name'         => _x( 'Family', 'Post Type Singular Name', 'blone' ),
        'menu_name'             => __( 'Families', 'blone' ),
        'name_admin_bar'        => __( 'Family', 'blone' ),
        'archives'              => __( 'Family Archives', 'blone' ),
        'attributes'            => __( 'Family Attributes', 'blone' ),
        'parent_item_colon'     => __( 'Parent Family:', 'blone' ),
        'all_items'             => __( 'All Families', 'blone' ),
        'add_new_item'          => __( 'Add New Family', 'blone' ),
        'add_new'               => __( 'Add New', 'blone' ),
        'new_item'              => __( 'New Family', 'blone' ),
        'edit_item'             => __( 'Edit Family', 'blone' ),
        'update_item'           => __( 'Update Family', 'blone' ),
        'view_item'             => __( 'View Family', 'blone' ),
        'view_items'            => __( 'View Families', 'blone' ),
        'search_items'          => __( 'Search Family', 'blone' ),
        'not_found'             => __( 'Not found', 'blone' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'blone' ),
        'featured_image'        => __( 'Featured Image', 'blone' ),
        'set_featured_image'    => __( 'Set featured image', 'blone' ),
        'remove_featured_image' => __( 'Remove featured image', 'blone' ),
        'use_featured_image'    => __( 'Use as featured image', 'blone' ),
        'insert_into_item'      => __( 'Insert into family', 'blone' ),
        'uploaded_to_this_item' => __( 'Uploaded to this family', 'blone' ),
        'items_list'            => __( 'Families list', 'blone' ),
        'items_list_navigation' => __( 'Families list navigation', 'blone' ),
        'filter_items_list'     => __( 'Filter families list', 'blone' ),
    );
    $args = array(
        'label'                 => __( 'Family', 'blone' ),
        'description'           => __( 'A custom post type for families', 'blone' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', 'revisions'),
        // 'taxonomies'            => array( 'genre', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 56,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,		
        'exclude_from_search'   => false,
        'publicly_queryable'    => false, // Hide Single Page
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'family', $args );

}
add_action( 'init', 'create_families_post_type', 0 );