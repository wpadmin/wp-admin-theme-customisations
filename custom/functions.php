<?php
/**
 * Custom functions
 *
 * @package ZHSH\ThemeCustomisations
 * @author  Zhenya Sh.
 * @link    https://github.com/wpadmin
 */

namespace ZHSH\ThemeCustomisations;

// Direct access protection.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register custom post types
 *
 * Example of registering custom post type.
 * Uncomment register_post_type() call to activate.
 */
function register_custom_post_types() {
    $labels = array(
        'name'               => _x( 'Projects', 'post type general name', 'zhsh-theme-customisations' ),
        'singular_name'      => _x( 'Project', 'post type singular name', 'zhsh-theme-customisations' ),
        'menu_name'          => _x( 'Projects', 'admin menu', 'zhsh-theme-customisations' ),
        'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'zhsh-theme-customisations' ),
        'add_new'            => _x( 'Add New', 'project', 'zhsh-theme-customisations' ),
        'add_new_item'       => __( 'Add New Project', 'zhsh-theme-customisations' ),
        'new_item'           => __( 'New Project', 'zhsh-theme-customisations' ),
        'edit_item'          => __( 'Edit Project', 'zhsh-theme-customisations' ),
        'view_item'          => __( 'View Project', 'zhsh-theme-customisations' ),
        'all_items'          => __( 'All Projects', 'zhsh-theme-customisations' ),
        'search_items'       => __( 'Search Projects', 'zhsh-theme-customisations' ),
        'parent_item_colon'  => __( 'Parent Projects:', 'zhsh-theme-customisations' ),
        'not_found'          => __( 'No projects found.', 'zhsh-theme-customisations' ),
        'not_found_in_trash' => __( 'No projects found in Trash.', 'zhsh-theme-customisations' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'menu_icon'          => 'dashicons-portfolio',
    );

    // Uncomment to activate custom post type.
    // register_post_type( 'project', $args );
}
add_action( 'init', __NAMESPACE__ . '\\register_custom_post_types' );

/**
 * Register custom taxonomies
 *
 * Example of registering custom taxonomy.
 * Uncomment register_taxonomy() call to activate.
 */
function register_custom_taxonomies() {
    $labels = array(
        'name'                       => _x( 'Project Categories', 'taxonomy general name', 'zhsh-theme-customisations' ),
        'singular_name'              => _x( 'Project Category', 'taxonomy singular name', 'zhsh-theme-customisations' ),
        'search_items'               => __( 'Search Categories', 'zhsh-theme-customisations' ),
        'popular_items'              => __( 'Popular Categories', 'zhsh-theme-customisations' ),
        'all_items'                  => __( 'All Categories', 'zhsh-theme-customisations' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Category', 'zhsh-theme-customisations' ),
        'update_item'                => __( 'Update Category', 'zhsh-theme-customisations' ),
        'add_new_item'               => __( 'Add New Category', 'zhsh-theme-customisations' ),
        'new_item_name'              => __( 'New Category Name', 'zhsh-theme-customisations' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'zhsh-theme-customisations' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'zhsh-theme-customisations' ),
        'choose_from_most_used'      => __( 'Choose from the most used categories', 'zhsh-theme-customisations' ),
        'not_found'                  => __( 'No categories found.', 'zhsh-theme-customisations' ),
        'menu_name'                  => __( 'Project Categories', 'zhsh-theme-customisations' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'project-category' ),
    );

    // Uncomment to activate custom taxonomy.
    // register_taxonomy( 'project_category', array( 'project' ), $args );
}
add_action( 'init', __NAMESPACE__ . '\\register_custom_taxonomies' );
