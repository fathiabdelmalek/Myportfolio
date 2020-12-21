<?php
session_start();
if(!isset($_SESSION['user']))
    redirect();
$title = isset($_GET['name']) ? $_GET['name'] . ' Project' : header('location: index.php');
include 'init.php';
$name = $_GET['name'];
$sql = $con->prepare("SELECT * FROM projects_view WHERE name=:name");
$sql->bindParam('name', $name);
$sql->execute();
$row = $sql->fetch();
$comments = selectRecords('*', 'comments_view', "projectname='$name'");
$sql = $con->prepare("SELECT id FROM users WHERE username=:username");
$username = $_SESSION['user'];
$sql->bindParam('username', $username);
$sql->execute();
$user = $sql->fetch();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = test_input($_POST['comment']);
    if(!empty($comment)) {
        $sql = $con->prepare("INSERT INTO comments (comment, project_id, user_id)
                                    VALUE (:comment, :project_id, :user_id)");
        $sql->bindParam('comment', $comment);
        $sql->bindParam('project_id', $row['id']);
        $sql->bindParam('user_id', $user['id']);
        $sql->execute();
        header("location: project.php?name=$name");
        exit();
    }
}
?>
<h1 class="text-center">Profile Page</h1>
<div class="container">
    <h2>Project Statistics</h2>
    <b>Name:</b> <?php echo $row['name']; ?><br>
    <b>Description:</b> <?php echo $row['description']; ?><br>
</div>
<div class="container mt-4">
    <?php if(!empty($comments)) { foreach ($comments as $comment) { ?>
        <div class="row">
            <div class="col-sm-2">
                <?php echo $comment['username'] ?>
            </div>
            <div class="col-sm-8">
                <?php echo $comment['comment'] ?>
            </div>
            <div class="col-sm-2">
                <?php echo $comment['add_date'] ?>
            </div>
        </div>
    <?php }} ?>
</div>
<div class="container mt-4">
    <h2>Add Comment</h2>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="form-group">
            <label>Your comment</label>
            <textarea class="form-control" name="comment" placeholder="your comment must be less than 500 character"></textarea>
        </div><br>
        <button class="btn btn-primary" type="submit">Add new comment</button>
    </form>
</div>
<?php include $inc . 'footer.php';
