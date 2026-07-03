<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="custom-header">

    <div class="header-container">

        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                Hasu
                <span>ARTESANAL</span>
            </a>
        </div>

        <nav class="main-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
            ));
            ?>
        </nav>

        <div class="menu-toggle" id="mobile-menu">
            ☰
        </div>

    </div>

</header>