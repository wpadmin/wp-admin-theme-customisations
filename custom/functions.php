<?php

/**
 * WP-Admin Theme Customisations - Пользовательские функции
 *
 * @package WP_Admin_Theme_Customisations
 * @version 1.1.0
 * @author WPAdmin
 * @link https://github.com/wpadmin
 */

// Запрет прямого доступа к файлу
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Регистрация пользовательских типов записей
 */
function wp_admin_tc_register_post_types()
{
    // Пример регистрации пользовательского типа записи
    $labels = array(
        'name'               => _x('Проекты', 'post type general name', 'wp-admin-theme-customisations'),
        'singular_name'      => _x('Проект', 'post type singular name', 'wp-admin-theme-customisations'),
        'menu_name'          => _x('Проекты', 'admin menu', 'wp-admin-theme-customisations'),
        'name_admin_bar'     => _x('Проект', 'add new on admin bar', 'wp-admin-theme-customisations'),
        'add_new'            => _x('Добавить новый', 'project', 'wp-admin-theme-customisations'),
        'add_new_item'       => __('Добавить новый проект', 'wp-admin-theme-customisations'),
        'new_item'           => __('Новый проект', 'wp-admin-theme-customisations'),
        'edit_item'          => __('Редактировать проект', 'wp-admin-theme-customisations'),
        'view_item'          => __('Просмотреть проект', 'wp-admin-theme-customisations'),
        'all_items'          => __('Все проекты', 'wp-admin-theme-customisations'),
        'search_items'       => __('Искать проекты', 'wp-admin-theme-customisations'),
        'parent_item_colon'  => __('Родительский проект:', 'wp-admin-theme-customisations'),
        'not_found'          => __('Проекты не найдены.', 'wp-admin-theme-customisations'),
        'not_found_in_trash' => __('В корзине проекты не найдены.', 'wp-admin-theme-customisations')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'projects'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'menu_icon'          => 'dashicons-portfolio'
    );

    // Раскомментируйте строку ниже для активации пользовательского типа записи
    // register_post_type( 'project', $args );
}
add_action('init', 'wp_admin_tc_register_post_types');

/**
 * Регистрация пользовательских таксономий
 */
function wp_admin_tc_register_taxonomies()
{
    // Пример регистрации пользовательской таксономии
    $labels = array(
        'name'                       => _x('Категории проектов', 'taxonomy general name', 'wp-admin-theme-customisations'),
        'singular_name'              => _x('Категория проекта', 'taxonomy singular name', 'wp-admin-theme-customisations'),
        'search_items'               => __('Искать категории', 'wp-admin-theme-customisations'),
        'popular_items'              => __('Популярные категории', 'wp-admin-theme-customisations'),
        'all_items'                  => __('Все категории', 'wp-admin-theme-customisations'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Редактировать категорию', 'wp-admin-theme-customisations'),
        'update_item'                => __('Обновить категорию', 'wp-admin-theme-customisations'),
        'add_new_item'               => __('Добавить новую категорию', 'wp-admin-theme-customisations'),
        'new_item_name'              => __('Название новой категории', 'wp-admin-theme-customisations'),
        'separate_items_with_commas' => __('Разделяйте категории запятыми', 'wp-admin-theme-customisations'),
        'add_or_remove_items'        => __('Добавить или удалить категории', 'wp-admin-theme-customisations'),
        'choose_from_most_used'      => __('Выбрать из наиболее используемых категорий', 'wp-admin-theme-customisations'),
        'not_found'                  => __('Категории не найдены.', 'wp-admin-theme-customisations'),
        'menu_name'                  => __('Категории проектов', 'wp-admin-theme-customisations'),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'project-category'),
    );

    // Раскомментируйте строку ниже для активации пользовательской таксономии
    // register_taxonomy( 'project_category', array( 'project' ), $args );
}
add_action('init', 'wp_admin_tc_register_taxonomies');

/**
 * Добавление новых функций ...
 */
