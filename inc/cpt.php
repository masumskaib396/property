<?php 

function property_register_cpts() {



	/**

	 * Post Type: data.

	 */

	$labels = array(

		"name" => __( "Propertys", "property" ),
		"singular_name" => __( "property", "property" ),
		"menu_name" => __( "Propertys", "property" ),
		"all_items" => __( "All property", "property" ),
		"add_new" => __( "Add New property", "property" ),
	);



	$args = array(
		"label" => __( "Propertys", "property" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		'menu_icon' => 'dashicons-book',
		"hierarchical" => false,
		"rewrite" => array( "slug" => "user-data", "with_front" => true ),
		"query_var" => true,
		"supports" => array( "title", "thumbnail", "page-attributes" ),
	);
	register_post_type( "user-data", $args );
}
add_action( 'init', 'property_register_cpts' );