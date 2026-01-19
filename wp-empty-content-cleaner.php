<?php
/**
 * Plugin Name: Empty Posts & Pages Cleaner
 * Description: Lists empty posts/pages and allows selective deletion.
 * Version: 1.0.4
 * Author: Intfinity
 */

if (!defined('ABSPATH')) {
    exit;
}

// Load admin-only files
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . 'includes/admin-page.php';
    require_once plugin_dir_path(__FILE__) . 'includes/delete-handler.php';
}

// Admin menu
add_action('admin_menu', function () {
    add_management_page(
        'Empty Content Cleaner',
        'Empty Content Cleaner',
        'manage_options',
        'empty-content-cleaner',
        'ecc_admin_page'
    );
});

function ecc_get_empty_posts() {
    global $wpdb;

    return $wpdb->get_results("
        SELECT ID, post_title, post_type, post_date
        FROM {$wpdb->posts}
        WHERE post_type IN ('post','page')
          AND post_status = 'publish'
          AND TRIM(COALESCE(post_content,'')) = ''
    ");
}
