<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= '/Myportfolio';
$path2 = '/Myportfolio';


$fun    = $path . '/includes/functions/';
$lng    = $path . '/includes/languages/';
$plg    = $path . '/includes/plugins/';
$inc    = $path . '/admin/includes/templates/';

$css    = $path2 . '/layout/css/';
$fonts  = $path2 . '/layout/fonts/';
$images = $path2 . '/layout/images/';
$js     = $path2 . '/layout/js/';

include 'connect.php';

include $fun . 'functions.php';
include $inc . 'header.php';
if(!isset($nav))
    include $inc . 'nav.php';
