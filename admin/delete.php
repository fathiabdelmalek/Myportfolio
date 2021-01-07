<?php
session_start();
$title = 'Delete user';
include 'init.php';
if(!isset($_SESSION['admin']))
    redirect();
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$sql = $con->prepare("SELECT * FROM users WHERE id=:id");
$sql->bindParam('id', $id);
$sql->execute();
$count = $sql->rowCount();
if($count > 0) {
    deleteRecord('users', ['id'], [$id]);
    redirect('back');
} else
    redirect("users.php?message=Wrong id");
include $inc . 'footer.php';
