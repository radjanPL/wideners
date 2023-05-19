<?php

global $post;
$current_ID = $post->ID;
$tags = wp_get_post_tags( $current_ID, array( 'fields' => 'ids' ) );
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 2,

    'ignore_sticky_posts'   =>  true,
    'no_found_rows' => true,
    'cache_results' => false,
    'post__not_in' => array( $current_ID ),
);
if ( empty( $tags ) ) return;

$args[ 'tag__in' ] = $tags;

$related_posts = get_posts( $args );

if ( $related_posts && count( $related_posts ) > 1 ) { ?>

<div id="related-area" class="single-component">
    
    <h2 class="related-title"><?php echo esc_html__( 'You may also like', 'wideners' ); ?></h2>
    
    <div class="related-posts-wrapper">
        
        <div class="related-posts">
            
            <?php foreach ( $related_posts as $post ) { setup_postdata($post); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-related' ); ?>>

                <?php if ( has_post_thumbnail() ) { ?>

                <figure class="post-related-thumbnail">

                    <a href="<?php the_permalink();?>">
                        
                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                        
                    </a>

                </figure><!-- .post-related-thumbnail -->

                <?php } ?>
                
                <div class="post-related-content">
                    
                    <h3 class="post-related-title">
                        
                        <a href="<?php the_permalink();?>">
                            
                            <?php the_title(); ?>
                            
                        </a>
                        
                    </h3>
                    
                    <div class="post-related-excerpt">
                        <p><?php echo rj_word_substr( get_the_excerpt(), 0, 18 ); ?>&hellip;</p>
                    </div>
                    
                </div><!-- .post-related-content -->

            </article>      

            <?php } // foreach ?>

        </div><!-- .related-posts -->
        
    </div>
    
</div><!-- #related-area -->

<?php
} // related_posts
            
wp_reset_postdata();
            
            ?>