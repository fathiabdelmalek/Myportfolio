<?php
session_start();
$title = 'Delete Comment';
include 'init.php';
if(!isset($_SESSION['admin']))
    redirect();
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$sql = $con->prepare("SELECT * FROM comments WHERE id=:id");
$sql->bindParam('id', $id);
$sql->execute();
$count = $sql->rowCount();
if($count > 0) {
    deleteRecord('comments', ['id'], [$id]);
    redirect('back');
}
include $inc . 'footer.php';
