
<?php
session_start();
$title = 'Dashboard';
include 'init.php';

if (!isset($_SESSION['user']))
    header('location: index.php');
?>
<h1 class="text-center">DashBoard</h1>
<?php include $inc . 'footer.php';
