<?php
session_start();
$title = 'Add new User';
include 'init.php';
if(!isset($_SESSION['user']))
    redirect(1);
$errors = array(
    'title'  => '',
);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title      = test_input($_POST['title']);
    $desc       = test_input($_POST['desc']);
    $visibility     = test_input($_POST['visibility']);
    $comments   = test_input($_POST['comments']);
    $ads        = test_input($_POST['ads']);
    $sql = $con->prepare("SELECT * FROM categories WHERE title=:title");
    $sql->execute(array('title'=>$title));
    if($sql->rowCount() > 0)
        $errors['title'] = "This title is already used";
    if(empty($errors['title'])) {
        $sql = $con->prepare("INSERT INTO categories (title, description, visibility, comments, ads)
                                    VALUE (:title, :desc, :visibility, :comments, :ads)");
        $sql->bindParam('title', $title);
        $sql->bindParam('desc', $desc);
        $sql->bindParam('visibility', $visibility);
        $sql->bindParam('comments', $comments);
        $sql->bindParam('ads', $ads);
        $sql->execute();
        redirect(3, 'back');
    }
}
?>
<article id="article" class="container" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-4">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Add New Category</h3>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input required class="form-control" type="text" name="title" placeholder="Category Title">
                            <span class="alert-sm alert-danger"><?php echo $errors['title']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="desc" placeholder="Description"></textarea>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Visibility</label>
                            <div class="form-check">
                                <span>
                                    <input checked id="visibilityy" type="radio" name="visibility" value="1">
                                    <label for="visibilityy">Visible</label>
                                </span>
                                <span>
                                    <input id="visibilityn" type="radio" name="visibility" value="0">
                                    <label for="visibilityn">Hidden</label>
                                </span>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Comments</label>
                            <div class="form-check">
                                <span>
                                    <input checked id="commentsy" type="radio" name="comments" value="1">
                                    <label for="commentsy">Yes</label>
                                </span>
                                <span>
                                    <input id="commentsn" type="radio" name="comments" value="0">
                                    <label for="commentsn">No</label>
                                </span>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Ads</label>
                            <div class="form-check">
                                <span>
                                    <input checked id="adsy" type="radio" name="ads" value="1">
                                    <label for="adsy">Yes</label>
                                </span>
                                <span>
                                    <input id="adsn" type="radio" name="ads" value="0">
                                    <label for="adsn">No</label>
                                </span>
                            </div>
                        </div><br>
                        <button class="btn btn-primary" type="submit">Add new category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
<?php include $inc . 'footer.php';
