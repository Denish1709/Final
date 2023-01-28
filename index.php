<?php 


    // require all the classes & functions files
    require "includes/class-db.php";
    // require "includes/class-user.php";
    require "includes/class-authentication.php";
    require "includes/class-form-validation.php";
    require "includes/class-csrf.php";
    // require "includes/class-post.php";

    // get route
    $path = trim( $_SERVER["REQUEST_URI"], '/' );

    // remove query string
    $path = parse_url( $path, PHP_URL_PATH );

    switch( $path ) {
        case 'about':
            require 'pages/about.php';
            break;
        case 'account':
            require 'pages/account.php';
            break;
        case 'auth':
            require 'pages/auth.php';
            break;
        case 'cart':
            require 'pages/cart.php';
            break;
        case 'catologue':
            require 'pages/catologue.php';
            break;
        case 'checkout':
            require 'pages/checkout.php';
            break;
        case 'config':
            require 'pages/config.php';
            break;
        case 'contact':
            require 'pages/contact.php';
            break;
        case 'details':
            require 'pages/details.php';
            break;
        case 'login':
            require 'pages/login.php';
            break;
        case 'logout':
            require 'pages/logout.php';
            break;
        case 'orderhistory':
            require 'pages/orderhistory.php';
            break;
        case 'register':
            require 'pages/register.php';
            break;
        case 'resetpassword':
            require 'pages/resetpassword.php';
            break;
        case 'search':
            require 'pages/search.php';
            break;
        case 'shoppingcart':
            require 'pages/shoppingcart.php';
            break;
        case 'support':
            require 'pages/support.php';
            break;
        case 'thankyou':
            require 'pages/thankyou.php';
            break;
        case 'updatedetails':
            require 'pages/updatedetails.php';
            break;
        case 'updaterating':
            require 'pages/updaterating.php';
            break;
        case 'usrinfo':
            require 'pages/usrinfo.php';
            break;
        case 'welcome':
            require 'pages/welcome.php';
            break;
        case 'admin/edituser':
            require 'admin/edituser.php';
            break;
        default:
            require 'pages/home.php';
            break;
    }

