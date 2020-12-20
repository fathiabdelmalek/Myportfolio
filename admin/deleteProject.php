<?php
session_start();
$title = 'Delete Project';
include 'init.php';
if(!isset($_SESSION['user']))
    redirect(1);
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$sql = $con->prepare("SELECT * FROM projects WHERE id=:id");
$sql->bindParam('id', $id);
$sql->execute();
$count = $sql->rowCount();
if($count > 0) {
    $sql = $con->prepare("DELETE FROM projects WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    echo '<div class="alert alert-success">' . $count . ' Record Deleted</div>';
    redirect(3, 'back');
} else {
    echo '<div class="alert alert-warning">Wrong id</div>';
    redirect(3, 'back');
}
include $inc . 'footer.php';
