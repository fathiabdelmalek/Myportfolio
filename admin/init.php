<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
//define('ROOT', $_SERVER['DOCUMENT_ROOT']);

//$css    = ROOT . 'admin/layout/css/';
//$fonts  = ROOT . 'admin/layout/fonts/';
//$images = ROOT . 'admin/layout/images/';
//$js     = ROOT . 'admin/layout/js/';
//
//$fun    = ROOT . 'admin/includes/functions/';
//$lng    = ROOT . 'admin/includes/languages/';
//$plg    = ROOT . 'admin/includes/plugins/';
//$inc    = ROOT . 'admin/includes/templates/';

//$css    = ROOT . 'layout/css/';
//$fonts  = ROOT . 'layout/fonts/';
//$images = ROOT . 'layout/images/';
//$js     = ROOT . 'layout/js/';
//
//$fun    = ROOT . 'includes/functions/';
//$lng    = ROOT . 'includes/languages/';
//$plg    = ROOT . 'includes/plugins/';
//$inc    = ROOT . 'includes/templates/';

//$css    = ROOT . DS . 'layout' . DS . 'css' . DS;
//$fonts  = ROOT . DS . 'layout' . DS . 'fonts' . DS;
//$images = ROOT . DS . 'layout' . DS . 'images' . DS;
//$js     = ROOT . DS . 'layout' . DS . 'js' . DS;
//
//$fun    = ROOT . DS . 'includes' . DS . 'functions' . DS;
//$lng    = ROOT . DS . 'includes' . DS . 'languages' . DS;
//$plg    = ROOT . DS . 'includes' . DS . 'plugins' . DS;
//$inc    = ROOT . DS . 'includes' . DS . 'templates' . DS;

//$css    = ROOT . DS . 'layout/css/';
//$fonts  = ROOT . DS . 'layout/fonts/';
//$images = ROOT . DS . 'layout/images/';
//$js     = ROOT . DS . 'layout/js/';
//
//$fun    = ROOT . DS . 'includes/functions/';
//$lng    = ROOT . DS . 'includes/languages/';
//$plg    = ROOT . DS . 'includes/plugins/';
//$inc    = ROOT . DS . 'includes/templates/';

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
