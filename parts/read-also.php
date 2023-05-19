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
    
    <aside id="read-also" class="read-also">
        <div class="read-also__header">
            <h3><?php echo esc_html__( 'Read Also', 'wideners' ); ?></h3>
            <button class="close">
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="read-also__posts">
            <?php foreach ( $related_posts as $post ) { setup_postdata($post); ?>
                <article id="post-<?php the_ID(); ?>">                              
                    <figure>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                        </a>
                    </figure>
                    <div>
                        <header>
                            <h3>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </header>
                        <p><?php echo rj_word_substr( get_the_excerpt(), 0, 10 ); ?></p>
                    </div>
                </article>
            <?php } // foreach ?>
        </div>
    </aside>
<?php } ?>