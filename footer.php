    <footer class="footer">
        <div class="footer__top">
            <div class="footer__top_col">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-1') ) : endif; ?>
            </div>
            <div class="footer__top_col">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-2') ) : endif; ?>
            </div>
            <div class="footer__top_col">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-3') ) : endif; ?>
                <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.0';
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                    </script>
                    <div class="fb-page" data-href="https://www.facebook.com/widenersonline" data-tabs="timeline" data-small-header="true"
                    data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false">
                        <blockquote cite="https://www.facebook.com/widenersonline" class="fb-xfbml-parse-ignore"><a
                                href="https://www.facebook.com/widenersonline">Widener&#039;s</a></blockquote>
                    </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer__bottom_col">
                <p>Copyright © <?php echo date("Y"); ?> Wideners.com</p>
            </div>
            <div class="footer__botom_col">
                <?php 
                    // Footer menu
                    wp_nav_menu(array(
                        'theme_location'  => 'footer_1',
                        'container'       => false,
                        'menu_class'      => 'footer__menu',
                    ));
                ?>
            </div>
        </div>
    </footer>
    
    <!-- Back to the top -->
    <a href="#top" id="scrollup" rel="nofollow" class="">
        <span id="scrollup-text-1">Take me</span>
        <span id="scrollup-text-2">Top ↑</span>
    </a>
    
    <!-- Read also widget - only on single post -->
    <?php if(is_single()) {
        get_template_part( 'parts/read-also' );
    } ?>
    
    <?php wp_footer(); ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-72480257-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-72480257-1');
    </script>
</body>
</html>