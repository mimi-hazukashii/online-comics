<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URI . '/assets/css/core.css'; ?>">
    <link rel="shortcut icon" href="<?php echo TEMPLATE_URI . '/assets/img/icon.png'; ?>" type="image/png">
    <title><?php bloginfo('name') ?></title>
</head>
<body <?php body_class(); ?>>
<div id="header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsible-navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsible-navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Popular Comics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">All Comics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Upcoming</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                </ul>
                <form class="form-inline search-form ml-auto" action="<?php bloginfo('url'); ?>">
                    <input class="form-control form-control-sm w-75" name="s" type="text" placeholder="Type here to search...">
                    <button class="btn btn-sm btn-danger" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <div class="account">
                    <?php if (!is_user_logged_in()): ?>
                        <a href="#">Login</a> &vert; <a href="#">Register</a>
                    <?php elseif (current_user_can('administrator')): ?>
                        <span class="admin"><i class="fas fa-star"></i> Admin</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</div>
