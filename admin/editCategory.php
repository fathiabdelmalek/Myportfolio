<?php
session_start();
$title = 'Edit Category';
include 'init.php';
$errors = array(
    'title' => '',
);
if(!isset($_SESSION['user']))
    redirect(1);
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$sql = $con->prepare("SELECT * FROM categories WHERE id=:id");
$sql->bindParam('id', $id);
$sql->execute();
$row = $sql->fetch();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title          = test_input($_POST['title']);
    $description    = test_input($_POST['description']);
    $ordering       = test_input($_POST['ordering']);
    $visibility         = test_input($_POST['visibility']);
    $comments       = test_input($_POST['comments']);
    $ads            = test_input($_POST['ads']);
    $sql = $con->prepare("SELECT * FROM categories WHERE title=:title");
    $sql->execute(array('title'=>$title));
    if($sql->rowCount() > 1)
        $errors['title'] = "This name is already used";
    if(empty($errors['title'])) {
        $sql = $con->prepare("UPDATE categories
                                    SET title=:title, description=:description, ordering=:ordering, 
                                        visibility=:visibility, comments=:comments, ads=:ads
                                    WHERE id=:id");
        $sql->bindParam('title', $title);
        $sql->bindParam('description', $description);
        $sql->bindParam('ordering', $ordering);
        $sql->bindParam('visibility', $visibility);
        $sql->bindParam('comments', $comments);
        $sql->bindParam('ads', $ads);
        $sql->bindParam('id', $id);
        $sql->execute();
        header("location:editCategory.php?id=$id");
        exit();
    }
}
?>
<article id="article" class="container" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-4">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Edit Category</h3>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input required class="form-control" type="text" name="title" value="<?php echo $row['title'] ?>">
                            <span class="alert-sm alert-danger"><?php echo $errors['title']; ?></span>
                        </div>
                        <div class="form-group">
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description"><?php echo $row['description'] ?></textarea>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Ordering</label>
                            <input class="form-control" type="number" name="ordering" value="<?php echo $row['ordering'] ?>">
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Visibility</label>
                            <div class="form-check">
                            <span>
                                <input <?php if($row['visibility'] == 1) echo 'checked' ?> id="visibilityy" type="radio" name="visibility" value="1">
                                <label for="visibilityy">Visible</label>
                            </span>
                                <span>
                                <input <?php if($row['visibility'] == 0) echo 'checked' ?> id="visibilityn" type="radio" name="visibility" value="0">
                                <label for="visibilityn">Hidden</label>
                            </span>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Comments</label>
                            <div class="form-check">
                            <span>
                                <input <?php if($row['comments'] == 1) echo 'checked' ?> id="commentsy" type="radio" name="comments" value="1">
                                <label for="commentsy">Yes</label>
                            </span>
                                <span>
                                <input <?php if($row['comments'] == 0) echo 'checked' ?> id="commentsn" type="radio" name="comments" value="0">
                                <label for="commentsn">No</label>
                            </span>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Ads</label>
                            <div class="form-check">
                            <span>
                                <input <?php if($row['ads'] == 1) echo 'checked' ?> id="adsy" type="radio" name="ads" value="1">
                                <label for="adsy">Yes</label>
                            </span>
                                <span>
                                <input <?php if($row['ads'] == 0) echo 'checked' ?> id="adsn" type="radio" name="ads" value="0">
                                <label for="adsn">No</label>
                            </span>
                            </div>
                        </div><br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
<?php include $inc . 'footer.php';
