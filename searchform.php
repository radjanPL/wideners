<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'wideners' ); ?></span>
	</label>
	<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Our Blog', 'placeholder', 'wideners' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    
    <button type="submit" class="submit search-btn" title="<?php esc_attr_e( 'Go' ,'danni' );?>">
        <img src="<?php echo get_template_directory_uri(); ?>/img/search.png">
    </button>
	
</form>