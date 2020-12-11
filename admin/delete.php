<?php
session_start();
$title = 'Delete user';
include 'init.php';
if(!isset($_SERSSION['user']))
    redirect(1);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $sql = $con->prepare("SELECT * FROM users WHERE id=:id");
    $sql->bindParam('id', $id);
    $sql->execute();
    $count = $sql->rowCount();
    if($count > 0) {
        $sql = $con->prepare("DELETE FROM users WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        echo '<div class="alert alert-success">' . $count . ' Record Deleted</div>';
        redirect(3);
    } else {
        echo '<div class="alert alert-warning">Wrong id</div>';
        redirect(3);
    }
} else {
    echo '<div class="alert alert-danger">Can\'t access to the page direclty</div>';
    redirect(1, 'add.php');
}
include $inc . 'footer.php';
