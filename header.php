<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(''); ?></title>
    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab&display=swap" rel="stylesheet">
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header id="top">
        <!-- Navbar -->
        <div class="navbar">

            <!-- Logo -->
            <a href="https://www.wideners.com/" class="navbar__logo">
                <img src="<?php echo get_template_directory_uri(); ?>/img/wideners-logo-shop.png" alt="Wideners Blog">
                <div>Shop Now</div>
            </a>

            <!-- Navbar menus -->
            <?php
                // Main menu
                wp_nav_menu(array(
                    'theme_location'  => 'primary',
                    'container'       => false,
                    'menu_class'      => 'navbar__menu',
                    'depth'           => 2
                ));

                // Social menu
                wp_nav_menu(array(
                    'theme_location'  => 'social_1',
                    'container'       => false,
                    'menu_class'      => 'navbar__social hide-on-mobile',
                    'link_before'     => '<span>',
                    'link_after'      => '</span>',
                ));
            ?>

            <!-- Hamburger menu -->
            <a id="btn-menu" class="navbar__hamburger" href="#">
                <span></span>
                <span></span>
                <span></span>
            </a>

        </div>

        <!-- Branding -->
        <div class="branding">

            <!-- Big logo -->
            <h1 class="branding__logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <?php

                        $logo = get_stylesheet_directory_uri() . '/img/Widener_s_Blog_Logo.png';

                        echo '<img src="' . esc_url( $logo ) . '" alt="' . esc_html__( 'Wideners Blog Logo', 'wideners' ) . '" />';
                    
                    ?>
                </a>
            </h1>

        </div>

    </header>