<?php
session_start();
$title = isset($_GET['username']) ? $_GET['username'] : header('location: index.php');
include 'init.php';
if(!isset($_SESSION['admin']))
    redirect();
$username = $_GET['username'];
$sql = $con->prepare("SELECT * FROM users WHERE username=:username");
$sql->bindParam('username', $username);
$sql->execute();
$row = $sql->fetch();
?>
<h1 class="text-center">Profile Page</h1>
<div class="container">
    <h2>User Statistics</h2>
    Username: <?php echo $row['username'] ?><br>
    Email: <?php echo $row['email'] ?><br>
</div>
<?php include $inc . 'footer.php';
