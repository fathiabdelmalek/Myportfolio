<?php
session_start();
if(!isset($_SESSION['user']))
    redirect();
session_unset();
session_destroy();
header('location: index.php');
exit();
