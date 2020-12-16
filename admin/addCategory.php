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
    $ordering   = (!empty($_POST['ordering'])) ? test_input($_POST['ordering']) : 0;
    $hidden     = test_input($_POST['hidden']);
    $comments   = test_input($_POST['comments']);
    $ads        = test_input($_POST['ads']);
//    $row = selectItems('*', 'categories', "title=$title");
    $sql = $con->prepare("SELECT * FROM categories WHERE title=:title");
    $sql->execute(array('title'=>$title));
    if($sql->rowCount() > 0)
//    if(empty($row))
        $errors['title'] = "This title is already used";
    if(empty($errors['title'])) {
        $sql = $con->prepare("INSERT INTO categories (title, description, ordering, hidden, comments, ads)
                                    VALUE (:title, :desc, :ordering, :hidden, :comments, :ads)");
        $sql->bindParam('title', $title);
        $sql->bindParam('desc', $desc);
        $sql->bindParam('ordering', $ordering);
        $sql->bindParam('hidden', $hidden);
        $sql->bindParam('comments', $comments);
        $sql->bindParam('ads', $ads);
        $sql->execute();
//        header('location: categories.php');
        redirect(3, 'back');
//        exit();
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
                        </div>
                        <div class="form-group">
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="desc" placeholder="Description"></textarea>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Ordering</label>
                            <input class="form-control" type="number" name="ordering" placeholder="The ordering">
                        </div><br>
                        <div class="form-group form-group-lg">
                            <label class="form-label">Visibility</label>
                            <div class="form-check">
                                <span>
                                    <input checked id="hiddeny" type="radio" name="hidden" value="1">
                                    <label for="hiddeny">Yes</label>
                                </span>
                                <span>
                                    <input id="hiddenn" type="radio" name="hidden" value="0">
                                    <label for="hiddenn">No</label>
                                </span>
                            </div>
                        </div><br>
                        <div class="form-group form-group-lg">
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
                        <div class="form-group form-group-lg">
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
