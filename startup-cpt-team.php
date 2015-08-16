<?php
/*
Plugin Name: StartUp Team Custom Post
Description: Le plugin pour activer le Custom Post Team
Author: Yann Caplain
Version: 1.0.0
*/

//CPT
function startup_reloaded_team() {
	$labels = array(
		'name'                => _x( 'Team members', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Team member', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Team', 'text_domain' ),
		'name_admin_bar'      => __( 'Team', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Items', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'new_item'            => __( 'New Item', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' )
	);
	$args = array(
		'label'               => __( 'team', 'text_domain' ),
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

// Metaboxes
function startup_reloaded_team_meta() {
    require get_template_directory() . '/inc/font-awesome.php';
    
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_startup_reloaded_team_';

	$cmb_box = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Team member details', 'cmb2' ),
		'object_types'  => array( 'team' )
	) );
    
    $cmb_box->add_field( array(
		'name'       => __( 'Capacity', 'cmb2' ),
		'id'         => $prefix . 'capacity',
		'type'       => 'text'
	) );
    
    $cmb_box->add_field( array(
        'name'             => __( 'Social icon 1', 'cmb2' ),
        'id'               => $prefix . 'icon_1',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => $font_awesome
    ) );

    $cmb_box->add_field( array(
		'name'       => __( 'Social link 1', 'cmb2' ),
		'id'         => $prefix . 'link_1',
		'type'       => 'text'
	) );
    
    $cmb_box->add_field( array(
        'name'             => __( 'Social icon 2', 'cmb2' ),
        'id'               => $prefix . 'icon_2',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => $font_awesome
    ) );

    $cmb_box->add_field( array(
		'name'       => __( 'Social link 2', 'cmb2' ),
		'id'         => $prefix . 'link_2',
		'type'       => 'text'
	) );
    
    $cmb_box->add_field( array(
        'name'             => __( 'Social icon 3', 'cmb2' ),
        'id'               => $prefix . 'icon_3',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => $font_awesome
    ) );

    $cmb_box->add_field( array(
		'name'       => __( 'Social link 3', 'cmb2' ),
		'id'         => $prefix . 'link_3',
		'type'       => 'text'
	) );
    
    $cmb_box->add_field( array(
        'name'             => __( 'Social icon 4', 'cmb2' ),
        'id'               => $prefix . 'icon_4',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => $font_awesome
    ) );

    $cmb_box->add_field( array(
		'name'       => __( 'Social link 4', 'cmb2' ),
		'id'         => $prefix . 'link_4',
		'type'       => 'text'
	) );
}

add_action( 'cmb2_init', 'startup_reloaded_team_meta' );
?>