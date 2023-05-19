<?php get_header(); ?>
    <main>

        <!-- Main column -->
        <div id="primary" class="content-area">
            <?php
            if ( have_posts() ) :
                while( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-standard' ); ?>>
                    
                    <a href="<?php echo get_permalink(); ?>" class="post-thumb-link">
                        <?php the_post_thumbnail('home-article-thumb'); ?>
                    </a>

                    <div class="post-content">
                    
                        <header class="post-header">

                            <h2 class="post-title">

                                <a href="<?php echo get_permalink(); ?>" rel="bookmark">

                                    <?php the_title(); ?>

                                </a>

                            </h2><!-- .post-title -->
                            
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

                        </header><!-- .post-header -->

                        <div class="entry-content entry-excerpt">
                            
                            <?php the_excerpt(); ?>
                            
                            <a href="<?php echo get_permalink(); ?>" class="more-link">
                                
                                <?php echo esc_html__( 'Keep Reading', 'wideners' ); ?>
                            
                            </a>
                            
                        </div><!-- .entry-content -->
                        
                    </div><!-- .post-content -->
                    
                </article><!-- #post-## -->

                <?php endwhile; ?>
                <?php // wideners_pagination(); ?>
            <?php
            else : // not have post

            endif;

            wp_reset_query();
            ?>

        </div>
        
        <!-- Sidebar -->
        <aside id="sidebar" role="complementary">
            <?php get_sidebar(); ?>
        </aside>

    </main>
<?php get_footer(); ?>