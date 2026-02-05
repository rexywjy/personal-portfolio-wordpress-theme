<?php

function portfolio_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'personal-portfolio'),
    ));
}
add_action('after_setup_theme', 'portfolio_theme_setup');

function portfolio_register_post_type() {
    $labels = array(
        'name' => 'Portfolio Items',
        'singular_name' => 'Portfolio Item',
        'add_new' => 'Add New Item',
        'add_new_item' => 'Add New Portfolio Item',
        'edit_item' => 'Edit Portfolio Item',
        'new_item' => 'New Portfolio Item',
        'view_item' => 'View Portfolio Item',
        'search_items' => 'Search Portfolio Items',
        'not_found' => 'No portfolio items found',
        'not_found_in_trash' => 'No portfolio items found in trash',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'thumbnail', 'author'),
        'rewrite' => array('slug' => 'portfolio'),
        'show_in_rest' => true,
    );
    
    register_post_type('portfolio', $args);
}
add_action('init', 'portfolio_register_post_type');

function portfolio_enqueue_scripts() {
    wp_enqueue_style('portfolio-style', get_stylesheet_uri());
    
    if (is_page_template('template-new-post.php') || is_singular('portfolio')) {
        wp_enqueue_script('marked-js', 'https://cdn.jsdelivr.net/npm/marked/marked.min.js', array(), '4.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'portfolio_enqueue_scripts');

function portfolio_handle_login() {
    if (!isset($_POST['portfolio_login_nonce']) || !wp_verify_nonce($_POST['portfolio_login_nonce'], 'portfolio_login')) {
        return;
    }
    
    $creds = array(
        'user_login' => sanitize_text_field($_POST['username']),
        'user_password' => $_POST['password'],
        'remember' => true
    );
    
    $user = wp_signon($creds, false);
    
    if (is_wp_error($user)) {
        wp_redirect(add_query_arg('login', 'failed', home_url('/login')));
        exit;
    }
    
    if (user_can($user, 'edit_posts')) {
        wp_redirect(home_url('/new-post'));
        exit;
    } else {
        wp_logout();
        wp_redirect(add_query_arg('login', 'unauthorized', home_url('/login')));
        exit;
    }
}
add_action('admin_post_nopriv_portfolio_login', 'portfolio_handle_login');
add_action('admin_post_portfolio_login', 'portfolio_handle_login');

function portfolio_handle_new_post() {
    if (!isset($_POST['portfolio_post_nonce']) || !wp_verify_nonce($_POST['portfolio_post_nonce'], 'portfolio_new_post')) {
        wp_die('Security check failed');
    }
    
    if (!current_user_can('edit_posts')) {
        wp_die('You do not have permission to post');
    }
    
    $title = sanitize_text_field($_POST['post_title']);
    $content = wp_kses_post($_POST['post_content']);
    
    $post_data = array(
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'publish',
        'post_type' => 'portfolio',
        'post_author' => get_current_user_id(),
    );
    
    $post_id = wp_insert_post($post_data);
    
    if ($post_id && !empty($_FILES['post_image']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        
        $attachment_id = media_handle_upload('post_image', $post_id);
        
        if (!is_wp_error($attachment_id)) {
            set_post_thumbnail($post_id, $attachment_id);
        }
    }
    
    if ($post_id) {
        wp_redirect(add_query_arg('posted', 'success', home_url('/new-post')));
        exit;
    } else {
        wp_redirect(add_query_arg('posted', 'error', home_url('/new-post')));
        exit;
    }
}
add_action('admin_post_portfolio_new_post', 'portfolio_handle_new_post');

function portfolio_handle_edit_post() {
    if (!isset($_POST['portfolio_edit_nonce']) || !wp_verify_nonce($_POST['portfolio_edit_nonce'], 'portfolio_edit_post')) {
        wp_die('Security check failed');
    }
    
    if (!current_user_can('edit_posts')) {
        wp_die('You do not have permission to edit posts');
    }
    
    $post_id = intval($_POST['post_id']);
    $title = sanitize_text_field($_POST['post_title']);
    $content = wp_kses_post($_POST['post_content']);
    
    $post_data = array(
        'ID' => $post_id,
        'post_title' => $title,
        'post_content' => $content,
    );
    
    wp_update_post($post_data);
    
    if (!empty($_FILES['post_image']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        
        $attachment_id = media_handle_upload('post_image', $post_id);
        
        if (!is_wp_error($attachment_id)) {
            set_post_thumbnail($post_id, $attachment_id);
        }
    }
    
    wp_redirect(get_permalink($post_id) . '?updated=success');
    exit;
}
add_action('admin_post_portfolio_edit_post', 'portfolio_handle_edit_post');

function portfolio_handle_delete_post() {
    if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'delete_post_' . $_GET['post_id'])) {
        wp_die('Security check failed');
    }
    
    if (!current_user_can('delete_posts')) {
        wp_die('You do not have permission to delete posts');
    }
    
    $post_id = intval($_GET['post_id']);
    wp_delete_post($post_id, true);
    
    wp_redirect(add_query_arg('deleted', 'success', home_url()));
    exit;
}
add_action('admin_post_portfolio_delete_post', 'portfolio_handle_delete_post');

function portfolio_parse_markdown($content) {
    return '<div class="markdown-content">' . wpautop($content) . '</div>';
}
