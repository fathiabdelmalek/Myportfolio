<?php

$css    = 'layout/css/';
$fonts  = 'layout/fonts/';
$images = 'layout/images/';
$js     = 'layout/js/';

$fun    = 'includes/functions/';
$lng    = 'includes/languages/';
$plg    = 'includes/plugins/';
$inc    = 'includes/templates/';

$user = '';
if(isset($_SESSION['user']))
    $user = $_SESSION['user'];
elseif(isset($_SESSION['admin']))
    $user = $_SESSION['admin'];

include 'connect.php';

include $fun . 'functions.php';
include $inc . 'header.php';
if(!isset($nav))
    include $inc . 'nav.php';
