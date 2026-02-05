<?php
/*
Template Name: New Post Page
*/

if (!is_user_logged_in() || !current_user_can('edit_posts')) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>

<main>
    <div class="container">
        <div class="post-form">
            <h2 style="text-align: center; margin-bottom: 2rem;">Create New Portfolio Item</h2>
            
            <?php if (isset($_GET['posted']) && $_GET['posted'] === 'success'): ?>
                <div class="alert alert-success">
                    Portfolio item posted successfully! <a href="<?php echo home_url(); ?>">View all posts</a>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['posted']) && $_GET['posted'] === 'error'): ?>
                <div class="alert alert-error">
                    There was an error posting your item. Please try again.
                </div>
            <?php endif; ?>
            
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data" id="portfolioForm">
                <input type="hidden" name="action" value="portfolio_new_post">
                <?php wp_nonce_field('portfolio_new_post', 'portfolio_post_nonce'); ?>
                
                <div class="form-group">
                    <label for="post_title">Title</label>
                    <input type="text" id="post_title" name="post_title" required placeholder="Enter your portfolio item title">
                </div>
                
                <div class="form-group">
                    <label for="post_image">Featured Image (optional)</label>
                    <input type="file" id="post_image" name="post_image" accept="image/*">
                    <div id="imagePreview" style="margin-top: 1rem;"></div>
                </div>
                
                <div class="form-group">
                    <label for="post_content">
                        Content (Supports Markdown)
                        <span style="font-weight: normal; font-size: 0.875rem; color: var(--text-light);">
                            - Use # for headings, **bold**, *italic*, - for lists
                        </span>
                    </label>
                    <textarea id="post_content" name="post_content" required placeholder="Write your content here using Markdown..."></textarea>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <h3 style="margin-bottom: 1rem;">Preview</h3>
                    <div id="markdownPreview" style="padding: 1.5rem; background: var(--bg-light); border-radius: 0.5rem; min-height: 100px;"></div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Publish Portfolio Item</button>
            </form>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contentTextarea = document.getElementById('post_content');
    const preview = document.getElementById('markdownPreview');
    const imageInput = document.getElementById('post_image');
    const imagePreview = document.getElementById('imagePreview');
    
    function updatePreview() {
        if (typeof marked !== 'undefined') {
            const markdown = contentTextarea.value;
            preview.innerHTML = marked.parse(markdown);
        } else {
            preview.textContent = 'Markdown preview will appear here...';
        }
    }
    
    contentTextarea.addEventListener('input', updatePreview);
    updatePreview();
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = '<img src="' + e.target.result + '" style="max-width: 100%; border-radius: 0.5rem;">';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '';
        }
    });
});
</script>

<?php get_footer(); ?>
