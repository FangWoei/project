<?php 

    // start session
    session_start();

    // require all the classes & functions files
    require "includes/class-db.php";
    require "includes/class-user.php";
    require "includes/class-authentication.php";
    require "includes/class-form-validation.php";
    require "includes/class-csrf.php";
    require "includes/class-information.php";

    // get route
    $path = trim( $_SERVER["REQUEST_URI"], '/' );

    // remove query string
    $path = parse_url( $path, PHP_URL_PATH );

    switch( $path ) {
        case 'login':
            require 'pages/login.php';
            break;
        case 'signup':
            require 'pages/signup.php';
            break;
        case 'logout':
            require 'pages/logout.php';
            break;
        case 'dashboard':
            require 'pages/dashboard.php';
            break;
        case 'information':
            require 'pages/information.php';
            break;
        case 'manage-users':
            require 'pages/manage-users.php';
            break;
        case 'manage-users-add':
            require 'pages/manage-users-add.php';
            break;
        case 'manage-users-edit':
            require 'pages/manage-users-edit.php';
            break;
        case 'manage-informations':
            require 'pages/manage-informations.php';
            break;
        case 'manage-informations-add':
            require 'pages/manage-informations-add.php';
            break;
        case 'manage-informations-edit':
            require 'pages/manage-informations-edit.php';
            break;
        case 'jokes':
            require 'pages/jokes.php';
            break;
        default:
            require 'pages/home.php';
            break;
    }

