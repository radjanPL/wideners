<?php
include "include/widgets.php";
include "include/corioliscalc.php";

add_theme_support( 'responsive-embeds' );
add_theme_support( 'post-thumbnails' );

// Remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// Remove dashicons in frontend for unauthenticated users
function theme_dequeue_dashicons() {
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
}
add_action( 'wp_enqueue_scripts', 'theme_dequeue_dashicons' );

// Register scripts & styles
function theme_rj_scripts() {

    // styles
    wp_enqueue_style( 'wp-default', get_stylesheet_uri() );
    wp_enqueue_style( 'theme-rj-style', get_stylesheet_directory_uri() . '/css/style.css?ver=1.2' );
  
    // scripts
    wp_enqueue_script('main-script', get_stylesheet_directory_uri() . '/js/main.js', array(), true, true );
  
}
add_action( 'wp_enqueue_scripts', 'theme_rj_scripts' );

// Register menus
register_nav_menus( array(
    'primary' => esc_html__( 'Main menu', 'wideners' ),
    'social_1' => esc_html__( 'Social menu', 'wideners' ), 
    'footer_1' => esc_html__( 'Footer menu', 'wideners' )
) );


// Custom image sizes
add_image_size( 'article-thumb', 300, 300, true ); // Hard Crop Mode
add_image_size( 'home-article-thumb', 790, 790, false );

//Register widgets
function wideners_widgets_init() {
    
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'wideners' ),
		'id'            => 'main',
		'description'   => esc_html__( 'Add widgets here to appear in your blog sidebar.', 'wideners' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'wideners' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'wideners' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'wideners' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'wideners' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'wideners' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'wideners' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
}
add_action( 'widgets_init', 'wideners_widgets_init' );


// Pagination
if ( ! function_exists( 'wideners_pagination' ) ) :
    function danni_pagination( $query = null ) {
        
        if ( ! $query ) {
            global $wp_query;
            $query = $wp_query;
        }
        
        $prev_label = esc_html__( 'Previous', 'wideners' );
        $next_label = esc_html__( 'Next', 'wideners' );
        
        $big = 999999999; // need an unlikely integer
        $pagination = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => ( is_front_page() && ! is_home() ) ? max( 1, get_query_var('page') ) : max( 1, get_query_var('paged') ),
            'total' => $query->max_num_pages,
            'type'			=> 'plain',
            'before_page_number'	=>	'<span>',
            'after_page_number'	=>	'</span>',
            'prev_text'    => '<span>' . $prev_label . '</span>',
            'next_text'    => '<span>' . $next_label . '</span>',
        ) );
        
        if ( $pagination ) {
            echo '<div class="wideners-pagination">' . $pagination  . '</div>';
        }
    
    }
endif;

// Custom substring
if ( ! function_exists( 'rj_word_substr' ) ) :
    function rj_word_substr( $str, $start = 0, $length = -1 ) {
        
        $chunks = explode( ' ', $str );
        $chunks = array_slice( $chunks, $start, $length );
        
        return join( ' ', $chunks );
    }
endif;