<?php get_header(); ?>
    <!-- Page title -->
    <div class="post-header">
        <h1 class="post-title">404</h1>
    </div>

    <main>

        <!-- Main column -->
        <div id="primary" class="content-area" style="width: 100%;">
            <div class="content404">
                <p><?php echo esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'wideners' ) ?></p>

                <?php get_search_form(); ?>
            </div>
        </div>

    </main>
<?php get_footer(); ?>
