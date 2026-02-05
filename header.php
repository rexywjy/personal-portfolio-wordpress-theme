<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <div class="container">
        <div class="header-content">
            <a href="<?php echo home_url(); ?>" class="site-title">
                <?php bloginfo('name'); ?>
            </a>
            
            <nav class="header-nav">
                <a href="<?php echo home_url(); ?>">Home</a>
                
                <?php if (is_user_logged_in() && current_user_can('edit_posts')): ?>
                    <a href="<?php echo home_url('/new-post'); ?>">New Post</a>
                    <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-outline">Logout</a>
                <?php else: ?>
                    <a href="<?php echo home_url('/login'); ?>" class="btn btn-primary">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>
