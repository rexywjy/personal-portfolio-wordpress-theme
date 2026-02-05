<?php get_header(); ?>

<main>
    <div class="container">
        <div class="single-portfolio">
            <?php if (isset($_GET['updated']) && $_GET['updated'] === 'success'): ?>
                <div class="alert alert-success">
                    Portfolio item updated successfully!
                </div>
            <?php endif; ?>
            
            <?php while (have_posts()): the_post(); ?>
                <article>
                    <h1 style="font-size: 2.5rem; margin-bottom: 1rem;"><?php the_title(); ?></h1>
                    
                    <div class="portfolio-meta" style="margin-bottom: 2rem; font-size: 1rem;">
                        Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?>
                    </div>
                    
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('large'); ?>
                    <?php endif; ?>
                    
                    <div class="portfolio-body" id="portfolioContent" data-raw-content="<?php echo esc_attr(get_the_content()); ?>">
                        <div class="markdown-loading">Loading content...</div>
                    </div>
                    
                    <?php if (is_user_logged_in() && current_user_can('edit_posts')): ?>
                        <div class="admin-actions">
                            <button onclick="toggleEditForm()" class="btn btn-primary">Edit</button>
                            <a href="<?php echo wp_nonce_url(admin_url('admin-post.php?action=portfolio_delete_post&post_id=' . get_the_ID()), 'delete_post_' . get_the_ID()); ?>" 
                               class="btn btn-outline" 
                               onclick="return confirm('Are you sure you want to delete this portfolio item?')">
                                Delete
                            </a>
                            <a href="<?php echo home_url(); ?>" class="btn btn-outline">Back to Home</a>
                        </div>
                        
                        <div id="editForm" style="display: none; margin-top: 2rem; padding: 2rem; background: var(--bg-light); border-radius: 1rem;">
                            <h3 style="margin-bottom: 1.5rem;">Edit Portfolio Item</h3>
                            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="portfolio_edit_post">
                                <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
                                <?php wp_nonce_field('portfolio_edit_post', 'portfolio_edit_nonce'); ?>
                                
                                <div class="form-group">
                                    <label for="edit_title">Title</label>
                                    <input type="text" id="edit_title" name="post_title" value="<?php echo esc_attr(get_the_title()); ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_image">Update Featured Image (optional)</label>
                                    <input type="file" id="edit_image" name="post_image" accept="image/*">
                                </div>
                                
                                <div class="form-group">
                                    <label for="edit_content">Content (Supports Markdown)</label>
                                    <textarea id="edit_content" name="post_content" required><?php echo esc_textarea(get_the_content()); ?></textarea>
                                </div>
                                
                                <div style="display: flex; gap: 1rem;">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" onclick="toggleEditForm()" class="btn btn-outline">Cancel</button>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<script>
function toggleEditForm() {
    const form = document.getElementById('editForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    if (typeof marked !== 'undefined') {
        const content = document.getElementById('portfolioContent');
        const rawContent = content.textContent.trim();
        
        if (rawContent && !content.querySelector('p') && !content.querySelector('h1')) {
            content.innerHTML = marked.parse(rawContent);
        }
    }
});
</script>

<?php get_footer(); ?>
