<?php get_header(); ?>
    <!-- Post title & meta -->
    <div class="post-header">
        <h1 class="post-title"><?php the_title(); ?></h1>
        <div class="entry-meta">
            <div class="entry-date">
                <span class="screen-reader-text">Posted on</span> 
                <time class="entry-date"><?php the_date('F j, Y'); ?></time>
            </div>
            <div class="entry-categories">
                <?php 
                    $separate_meta = '<span class="sep">' . esc_html__( '/', 'wideners' ) . '</span>';
                    echo get_the_category_list( $separate_meta ); 
                ?>
            </div>               
        </div>
    </div>

    <main>
        <!-- Main column -->
        <div id="primary" class="content-area">

            <figure class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </figure>

            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            <?php the_content();?>
            <?php endwhile; ?>
            <?php endif; ?>  

            <?php get_template_part('include/share') ?>

            <div class="post-tags">
                <?php the_tags('', '', '' ) ?>
            </div>

            <?php get_template_part( 'parts/related' ); ?>

        </div>
        
        <!-- Sidebar -->
        <aside id="sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </aside>

    </main>
<?php get_footer(); ?>