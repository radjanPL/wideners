<?php get_header(); ?>
    <!-- Page title -->
    <div class="post-header">
        <h1 class="post-title"><?php the_title(); ?></h1>
    </div>

    <main>

        <!-- Main column -->
        <div id="primary" class="content-area">
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            <?php the_content();?>
            <?php endwhile; ?>
            <?php endif; ?>  

            <?php get_template_part('include/share') ?>
        </div>
        
        <!-- Sidebar -->
        <aside id="sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </aside>

    </main>
<?php get_footer(); ?>