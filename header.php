<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/core.css'; ?>">
    <link rel="icon" href="<?php echo get_template_directory_uri() . '/assets/images/icon.png'; ?>" type="image/png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsible-navbar">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="collapsible-navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/popular">Popular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/all">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/upcoming">Upcoming</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        Categories
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline search-form" action="<?php bloginfo('url'); ?>">
                <input class="form-control form-control-sm" type="text" name="s" placeholder="Type here to search...">
                <i class="fas fa-search"></i>
                <button class="d-none" type="submit">Search</button>
            </form>
            <div class="account">
                <?php if (!is_user_logged_in()): ?>
                    <a href="/login">Login</a> &vert; <a href="/register">Register</a>
                <?php elseif (current_user_can('administrator') || current_user_can('editor')): ?>
                    <div class="dropdown">
                        <?php if (current_user_can('administrator')): ?>
                            <span class="dropdown-toggle admin-tag" data-toggle="dropdown">Admin</span>
                        <?php else: ?>
                            <span class="dropdown-toggle admin-tag" data-toggle="dropdown">Uploader</span>
                        <?php endif; ?>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo get_dashboard_url(); ?>">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                            <?php if (is_single()): ?>
                                <a class="dropdown-item" href="<?php echo get_edit_post_link(); ?>">
                                    <i class="fas fa-edit"></i> Edit Post
                                </a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="<?php echo wp_logout_url(home_url()); ?>">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                <?php elseif (current_user_can('subscriber')): ?>
                    <a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
