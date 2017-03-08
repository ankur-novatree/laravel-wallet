<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="demo desc">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Laravel Wallet</title>
    <link rel="stylesheet" href="{{ asset('assets/wallet/css/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Material+Icons' rel='stylesheet' type='text/css'>
</head>
<body class="light-ver has-shrink has-fixed-header" style="position: relative">
<div id="menu-1" class="lg-menu__container" data-position="bottom left" data-width="4">
    <div class="lg-menu">
        <div class="lg-menu__item">
            <a class="lg-button" href="buttons">
                Button
            </a>
        </div>
        <div class="lg-menu__item">
            <a class="lg-button" href="form">
                Form
            </a>
        </div>
        <div class="lg-menu__item">
            <a class="lg-button" href="table">
                Table
            </a>
        </div>
        <div class="lg-menu__item">
            <a class="lg-button" href="menu">
                Menu
            </a>
        </div>
    </div>
</div>
<div id="menu-2" class="lg-menu__container has-offset" data-width="3">
    <div class="lg-menu">
        <div class="lg-menu__item">
            <a class="lg-button" href="buttons">
                My Account
            </a>
        </div>
        <div class="lg-menu__item">
            <a class="lg-button" href="form">
                My Orders
            </a>
        </div>
        <div class="lg-menu__item">
            <a class="lg-button" href="table">
                Sign out
            </a>
        </div>
    </div>
</div>
<header class="lg-navbar--default is-casting-shadow lg-layout__header is-fixed">
    <div class="lg-layout__header-row layout-gutter flex-grow pos-rel">
        <div class="lg-typography--headline">
            Laravel Wallet Admin
        </div>
        <a href="javascript:;" class="lg-layout__drawer-button lg-text-white" tabindex="0" role="button" data-toggle="drawer" data-target="#drawer-1" aria-expanded="false">
            <i class="material-icons">menu</i>
        </a>
        <div class="lg-layout-spacer"></div>
        <button class="lg-button lg-js-button lg-button--icon lg-text-white" data-toggle="menu-bar" data-position="bottom right" data-target="#menu-2">
            <i class="material-icons">account_circle</i>
        </button>
        <button class="lg-button lg-js-button lg-button--icon lg-text-white">
            <i class="material-icons">more_vert</i>
        </button>
    </div>
</header>
<aside class="lg-layout__drawer-wrapper" id="drawer-1">
    <div class="lg-layout__drawer-shadow"></div>
    <div aria-hidden="true" class="lg-layout__drawer lg-layout__drawer-general drawer--1">
          <span class="lg-layout-title">
              <img style="width: 160px; height: auto" src="https://www.leagueguru.com/assets/images/logo.png">
          </span>
        <nav class="lg-navigation lg-navigation-style">
            <a class="lg-navigation__link is-active" href="https://www.leagueguru.com">Home</a>
            <a class="lg-navigation__link" href="https://www.leagueguru.com/how-to-play">How to play</a>
            <a class="lg-navigation__link" href="https://www.leagueguru.com/about-us">About us</a>
            <a class="lg-navigation__link" href="https://www.leagueguru.com/support">FAQ</a>
            <a class="lg-navigation__link" href="https://www.leagueguru.com/terms-and-conditions">Terms of use</a>
            <div class="lg-navigation__wrapper">
                <a class="lg-navigation__link" data-toggle="collapse" data-parent="#accordion2" href="#subMenu2" aria-expanded="false">My Account</a>
            </div>
            <div id="subMenu2" class="collapse" aria-expanded="false">
                <a class="lg-navigation__link lg-navigation__link-sub" href="https://leagueguru.com/account-details">User info</a>
                <a class="lg-navigation__link lg-navigation__link-sub" href="https://leagueguru.com/change_password">Change Password </a>
                <a class="lg-navigation__link lg-navigation__link-sub" href="https://leagueguru.com/ticket">Post Ticket</a>
            </div>
            <a class="lg-navigation__link" href="https://www.leagueguru.com/privacy">Privacy Policy</a>
        </nav>
    </div>
</aside>
<div class="lg-layout-padding--section is-first">
    <div class="lg-layout-container lg-layout-container--box">
        @yield('content')
    </div>
</div>


<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/wallet/js/drawer.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/wallet/js/input.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/wallet/js/menu-bar.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/wallet/js/radio.js') }}"></script>

</body>
</html>