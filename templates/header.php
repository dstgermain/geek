<div class="mobile-navigation visible-xs">
    <?php
        if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
    ?>
</div>
<div id="mobile-container">

<header class="banner navbar-default navbar-static-top" role="banner">
    <div class="geek-header">
        <button type="button" class="nav-open">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <small>menu</small>
            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header">
            <div class="header-logo">
                <a href="/">
                    <img src="/wp-content/themes/roots-master/assets/img/geeklogo.png" />
                </a>
            </div>
        </div>
        <nav class="navigation hidden-xs pull-right clearfix" role="navigation">
            <div class="primary-navigation pull-right">
                <?php
                    if (has_nav_menu('primary_navigation')) :
                        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
                    endif;
                ?>
            </div>
        </nav>
    </div>
</header>
<div class="fixed-nav-spacer"></div>
