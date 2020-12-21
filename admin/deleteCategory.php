<?php
session_start();
if(!isset($_SESSION['user']))
    redirect();
$title = 'Delete Category';
include 'init.php';
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$sql = $con->prepare("SELECT * FROM categories WHERE id=:id");
$sql->bindParam('id', $id);
$sql->execute();
$count = $sql->rowCount();
if($count > 0) {
    deleteRecord('categories', ['id'], [$id]);
    redirect('categories.php');
} else
    redirect("categories.php?message=Wrong id");
include $inc . 'footer.php';
