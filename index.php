<?php get_header(); ?>

<main>
    <div class="hero">
        <div class="container">
            <h1><?php bloginfo('name'); ?></h1>
            <p><?php bloginfo('description'); ?></p>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] === 'success'): ?>
            <div class="alert alert-success">
                Portfolio item deleted successfully!
            </div>
        <?php endif; ?>

        <div class="portfolio-grid">
            <?php
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            
            $portfolio_query = new WP_Query($args);
            
            if ($portfolio_query->have_posts()):
                while ($portfolio_query->have_posts()): $portfolio_query->the_post();
            ?>
                <article class="portfolio-item">
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                    <?php endif; ?>
                    
                    <div class="portfolio-content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        
                        <div class="portfolio-meta">
                            Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?>
                        </div>
                        
                        <div class="portfolio-excerpt">
                            <?php 
                            $content = get_the_content();
                            $clean_content = portfolio_strip_markdown($content);
                            echo wp_trim_words($clean_content, 30); 
                            ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="read-more">Read more →</a>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
            ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 4rem 0;">
                    <h2 style="color: var(--text-light);">No portfolio items yet</h2>
                    <?php if (is_user_logged_in() && current_user_can('edit_posts')): ?>
                        <p style="margin-top: 1rem;">
                            <a href="<?php echo home_url('/new-post'); ?>" class="btn btn-primary">Create Your First Post</a>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
