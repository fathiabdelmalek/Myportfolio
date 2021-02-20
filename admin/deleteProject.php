<?php
session_start();
$title = 'Delete Project';
include 'init.php';
if(!isset($_SESSION['admin']))
    redirect();
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$sql = $con->prepare("SELECT * FROM projects WHERE id=:id");
$sql->bindParam('id', $id);
$sql->execute();
$count = $sql->rowCount();
if($count > 0) {
    deleteRecord('projects', ['id'], [$id]);
    redirect('back');
} else
    redirect("projects.php?message=Wrong id");
include $inc . 'footer.php';
