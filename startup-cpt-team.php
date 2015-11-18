<?php
/*
Plugin Name: StartUp CPT Team
Description: Le plugin pour activer le Custom Post Team
Author: Yann Caplain
Version: 1.2.0
Text Domain: startup-cpt-team
*/

//GitHub Plugin Updater
function startup_reloaded_team_updater() {
	include_once 'lib/updater.php';
	//define( 'WP_GITHUB_FORCE_UPDATE', true );
	if ( is_admin() ) {
		$config = array(
			'slug' => plugin_basename( __FILE__ ),
			'proper_folder_name' => 'startup-cpt-team',
			'api_url' => 'https://api.github.com/repos/yozzi/startup-cpt-team',
			'raw_url' => 'https://raw.github.com/yozzi/startup-cpt-team/master',
			'github_url' => 'https://github.com/yozzi/startup-cpt-team',
			'zip_url' => 'https://github.com/yozzi/startup-cpt-team/archive/master.zip',
			'sslverify' => true,
			'requires' => '3.0',
			'tested' => '3.3',
			'readme' => 'README.md',
			'access_token' => '',
		);
		new WP_GitHub_Updater( $config );
	}
}

//add_action( 'init', 'startup_reloaded_team_updater' );

//CPT
function startup_reloaded_team() {
	$labels = array(
		'name'                => _x( 'Team members', 'Post Type General Name', 'startup-cpt-team' ),
		'singular_name'       => _x( 'Team member', 'Post Type Singular Name', 'startup-cpt-team' ),
		'menu_name'           => __( 'Team', 'startup-cpt-team' ),
		'name_admin_bar'      => __( 'Team', 'startup-cpt-team' ),
		'parent_item_colon'   => __( 'Parent Item:', 'startup-cpt-team' ),
		'all_items'           => __( 'All Items', 'startup-cpt-team' ),
		'add_new_item'        => __( 'Add New Item', 'startup-cpt-team' ),
		'add_new'             => __( 'Add New', 'startup-cpt-team' ),
		'new_item'            => __( 'New Item', 'startup-cpt-team' ),
		'edit_item'           => __( 'Edit Item', 'startup-cpt-team' ),
		'update_item'         => __( 'Update Item', 'startup-cpt-team' ),
		'view_item'           => __( 'View Item', 'startup-cpt-team' ),
		'search_items'        => __( 'Search Item', 'startup-cpt-team' ),
		'not_found'           => __( 'Not found', 'startup-cpt-team' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'startup-cpt-team' )
	);
	$args = array(
		'label'               => __( 'team', 'startup-cpt-team' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-groups',
		'show_in_admin_bar'   => false,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
        'capability_type'     => array('team_member','team_members'),
        'map_meta_cap'        => true
	);
	register_post_type( 'team', $args );
}

add_action( 'init', 'startup_reloaded_team', 0 );

//Flusher les permalink à l'activation du plugin pour qu'ils fonctionnent sans mise à jour manuelle
function startup_reloaded_team_rewrite_flush() {
    startup_reloaded_team();
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'startup_reloaded_team_rewrite_flush' );

// Capabilities
function startup_reloaded_team_caps() {
	$role_admin = get_role( 'administrator' );
	$role_admin->add_cap( 'edit_team_member' );
	$role_admin->add_cap( 'read_team_member' );
	$role_admin->add_cap( 'delete_team_member' );
	$role_admin->add_cap( 'edit_others_team_members' );
	$role_admin->add_cap( 'publish_team_members' );
	$role_admin->add_cap( 'edit_team_members' );
	$role_admin->add_cap( 'read_private_team_members' );
	$role_admin->add_cap( 'delete_team_members' );
	$role_admin->add_cap( 'delete_private_team_members' );
	$role_admin->add_cap( 'delete_published_team_members' );
	$role_admin->add_cap( 'delete_others_team_members' );
	$role_admin->add_cap( 'edit_private_team_members' );
	$role_admin->add_cap( 'edit_published_team_members' );
}

register_activation_hook( __FILE__, 'startup_reloaded_team_caps' );

// Team taxonomy
function startup_reloaded_team_categories() {
	$labels = array(
		'name'                       => _x( 'Team Categories', 'Taxonomy General Name', 'startup-cpt-team' ),
		'singular_name'              => _x( 'Team Category', 'Taxonomy Singular Name', 'startup-cpt-team' ),
		'menu_name'                  => __( 'Team Categories', 'startup-cpt-team' ),
		'all_items'                  => __( 'All Items', 'startup-cpt-team' ),
		'parent_item'                => __( 'Parent Item', 'startup-cpt-team' ),
		'parent_item_colon'          => __( 'Parent Item:', 'startup-cpt-team' ),
		'new_item_name'              => __( 'New Item Name', 'startup-cpt-team' ),
		'add_new_item'               => __( 'Add New Item', 'startup-cpt-team' ),
		'edit_item'                  => __( 'Edit Item', 'startup-cpt-team' ),
		'update_item'                => __( 'Update Item', 'startup-cpt-team' ),
		'view_item'                  => __( 'View Item', 'startup-cpt-team' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'startup-cpt-team' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'startup-cpt-team' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'startup-cpt-team' ),
		'popular_items'              => __( 'Popular Items', 'startup-cpt-team' ),
		'search_items'               => __( 'Search Items', 'startup-cpt-team' ),
		'not_found'                  => __( 'Not Found', 'startup-cpt-team' )
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false
	);
	register_taxonomy( 'team-category', array( 'team' ), $args );

}

add_action( 'init', 'startup_reloaded_team_categories', 0 );

// Retirer la boite de la taxonomie sur le coté
function startup_reloaded_team_categories_metabox_remove() {
	remove_meta_box( 'tagsdiv-team-category', 'team', 'side' );
    // tagsdiv-product_types pour les taxonomies type tags
    // custom_taxonomy_slugdiv pour les taxonomies type categories
}

add_action( 'admin_menu' , 'startup_reloaded_team_categories_metabox_remove' );

// Metaboxes
function startup_reloaded_team_meta() {
    require get_template_directory() . '/inc/font-awesome.php';
    
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_startup_reloaded_team_';

	$cmb_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Team member details', 'startup-cpt-team' ),
		'object_types'  => array( 'team' )
	) );
    
    $cmb_box->add_field( array(
		'name'     => __( 'Categoy', 'startup-cpt-team' ),
		'desc'     => __( 'Select the category(ies) of the team member', 'startup-cpt-team' ),
		'id'       => $prefix . 'category',
		'type'     => 'taxonomy_multicheck',
		'taxonomy' => 'team-category', // Taxonomy Slug
		'inline'  => true // Toggles display to inline
	) );
    
    $cmb_box->add_field( array(
		'name'       => __( 'Capacity', 'startup-cpt-team' ),
		'id'         => $prefix . 'capacity',
		'type'       => 'text'
	) );
    
    $cmb_box->add_field( array(
        'name'             => __( 'Social icon 1', 'startup-cpt-team' ),
        'id'               => $prefix . 'icon_1',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => $font_awesome
    ) );

    $cmb_box->add_field( array(
		'name'       => __( 'Social link 1', 'startup-cpt-team' ),
		'id'         => $prefix . 'link_1',
		'type'       => 'text'
	) );
    
    $cmb_box->add_field( array(
        'name'             => __( 'Social icon 2', 'startup-cpt-team' ),
        'id'               => $prefix . 'icon_2',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => $font_awesome
    ) );

    $cmb_box->add_field( array(
		'name'       => __( 'Social link 2', 'startup-cpt-team' ),
		'id'         => $prefix . 'link_2',
		'type'       => 'text'
	) );
    
    $cmb_box->add_field( array(
        'name'             => __( 'Social icon 3', 'startup-cpt-team' ),
        'id'               => $prefix . 'icon_3',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => $font_awesome
    ) );

    $cmb_box->add_field( array(
		'name'       => __( 'Social link 3', 'startup-cpt-team' ),
		'id'         => $prefix . 'link_3',
		'type'       => 'text'
	) );
    
    $cmb_box->add_field( array(
        'name'             => __( 'Social icon 4', 'startup-cpt-team' ),
        'id'               => $prefix . 'icon_4',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => $font_awesome
    ) );

    $cmb_box->add_field( array(
		'name'       => __( 'Social link 4', 'startup-cpt-team' ),
		'id'         => $prefix . 'link_4',
		'type'       => 'text'
	) );
    
    // Pull all the pages into an array
    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'hierarchical' => 0
    ); 
    
	$pages = array();
	$pages_obj = get_pages( $args );
	foreach ($pages_obj as $page) {
		$pages[$page->post_name] = $page->post_title;
	}
    
    $cmb_box->add_field( array(
        'name'             => __( 'Profile page', 'startup-cpt-team' ),
        'id'               => $prefix . 'page',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => $pages
    ) );

}

add_action( 'cmb2_admin_init', 'startup_reloaded_team_meta' );

// Shortcode
function startup_reloaded_team_shortcode( $atts ) {

	// Attributes
    $atts = shortcode_atts(array(
            'bg' => '#f0f0f0',
            'order' => '',
            'cat' => '',
            'id' => '',
        ), $atts);
    
	// Code
        ob_start();
        require get_template_directory() . '/template-parts/content-team.php';
        return ob_get_clean();    
}
add_shortcode( 'team', 'startup_reloaded_team_shortcode' );
?>