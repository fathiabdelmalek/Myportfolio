<?php
//define('DS', DIRECTORY_SEPARATOR);
//define('ROOT', dirname(__FILE__));

$css    = 'layout/css/';
$fonts  = 'layout/fonts/';
$images = 'layout/images/';
$js     = 'layout/js/';

$fun    = 'includes/functions/';
$lng    = 'includes/languages/';
$plg    = 'includes/plugins/';
$inc    = 'includes/templates/';

include 'connect.php';

include $fun . 'functions.php';
include $inc . 'header.php';
if(!isset($nav))
    include $inc . 'nav.php';

