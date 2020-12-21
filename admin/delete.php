<?php
session_start();
if(!isset($_SESSION['user']))
    redirect();
$title = 'Delete user';
include 'init.php';
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$sql = $con->prepare("SELECT * FROM users WHERE id=:id");
$sql->bindParam('id', $id);
$sql->execute();
$count = $sql->rowCount();
if($count > 0) {
    deleteRecord('users', ['id'], [$id]);
    redirect('users.php');
} else
    redirect("users.php?message=Wrong id");
include $inc . 'footer.php';
