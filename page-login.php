<?php
/*
Template Name: Login Page
*/

if (is_user_logged_in() && current_user_can('edit_posts')) {
    wp_redirect(home_url('/new-post'));
    exit;
}

get_header();
?>

<main>
    <div class="container">
        <div class="login-form">
            <h2 style="text-align: center; margin-bottom: 2rem;">Maintainer Login</h2>
            
            <?php if (isset($_GET['login']) && $_GET['login'] === 'failed'): ?>
                <div class="alert alert-error">
                    Invalid username or password. Please try again.
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['login']) && $_GET['login'] === 'unauthorized'): ?>
                <div class="alert alert-error">
                    You do not have permission to post. Only maintainers can access this area.
                </div>
            <?php endif; ?>
            
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="portfolio_login">
                <?php wp_nonce_field('portfolio_login', 'portfolio_login_nonce'); ?>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </form>
        </div>
    </div>
</main>

<?php get_footer(); ?>
