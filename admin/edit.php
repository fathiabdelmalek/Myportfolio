<?php
session_start();
$title = 'Edit page';
include 'init.php';
if(!isset($_SERSSION['user']))
    redirect(1);
?>
<h1 class="text-center">Edit Page</h1>
<?php include $inc . 'footer.php';
