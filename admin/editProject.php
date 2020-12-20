<?php
session_start();
$title = 'Edit Project';
include 'init.php';
$errors = array(
    'name'          => '',
    'description'   => '',
    'category'      => '',
    'user'          => ''
);
if(!isset($_SESSION['user']))
    redirect(1);
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$sql = $con->prepare("SELECT * FROM projects_view WHERE id=:id");
$sql->bindParam('id', $id);
$sql->execute();
$row = $sql->fetch();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name           = test_input($_POST['name']);
    $description    = test_input($_POST['description']);
    $category       = test_input($_POST['category']);
    $user           = test_input($_POST['user']);
    $visibility     = test_input($_POST['visibility']);
    $sql = $con->prepare("SELECT * FROM projects WHERE name=:name");
    $sql->execute(array('name'=>$name));
    if(empty($name))
        $errors['name'] = 'Name can\'t be empty';
    if(empty($description))
        $errors['description'] = 'Description can\'t be empty';
    if(empty($category))
        $errors['category'] = 'Category can\'t be empty';
    if(empty($user))
        $errors['user'] = 'User can\'t be empty';
    if(empty($errors['name']) && empty($errors['description']) && empty($errors['category']) && empty($errors['user'])) {
        $sql = $con->prepare("UPDATE projects
                                    SET name=:name, description=:description, visibility=:visibility, userID=:user, categoryID=:category
                                    WHERE id=:id");
        $sql->bindParam('name', $name);
        $sql->bindParam('description', $description);
        $sql->bindParam('visibility', $visibility);
        $sql->bindParam('user', $user);
        $sql->bindParam('category', $category);
        $sql->bindParam('id', $id);
        $sql->execute();
        header("location:editProject.php?id=$id");
        exit();
    }
}
?>
<article id="article" class="container" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-4">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Add New Project</h3>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input  class="form-control" type="text" name="name" value="<?php echo $row['name'] ?>">
                            <span class="alert-sm alert-danger"><?php echo $errors['name']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea  class="form-control" name="description"><?php echo $row['description'] ?></textarea>
                            <span class="alert-sm alert-danger"><?php echo $errors['description']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Category</label><br>
                            <select required="required" name="category">
                                <option value="0">...</option>
                                <?php
                                $sql = $con->prepare("SELECT * FROM `categories`");
                                $sql->execute();
                                $rows = $sql->fetchAll();
                                foreach ($rows as $cat) {?>
                                    <option <?php if($cat['title'] === $row['category_title']){ echo 'selected'; } ?> value="<?php echo $cat['id'] ?>"><?php echo $cat['title'] ?></option>;
                                <?php } ?>
                            </select>
                            <span class="alert-sm alert-danger"><?php echo $errors['category']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">User</label><br>
                            <select required="required" name="user">
                                <option selected value="0">...</option>
                                <?php
                                $sql = $con->prepare( "SELECT * FROM `users`");
                                $sql->execute();
                                $rows = $sql->fetchAll();
                                foreach ($rows as $user) { ?>
                                    <option <?php if($user['username'] === $row['username']){ echo 'selected'; } ?> value="<?php echo $user['id'] ?>"><?php echo $user['username'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="alert-sm alert-danger"><?php echo $errors['user']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Visibility</label>
                            <div class="form-check">
                            <span>
                                <input <?php if($row['visibility'] == 1) echo 'checked' ?> id="visibilityy" type="radio" name="visibility" value="1">
                                <label for="visibilityy">Public</label>
                            </span>
                                <span>
                                <input <?php if($row['visibility'] == 0) echo 'checked' ?> id="visibilityn" type="radio" name="visibility" value="0">
                                <label for="visibilityn">Private</label>
                            </span>
                            </div>
                        </div><br>
                        <button class="btn btn-primary" type="submit">Edit Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
<?php include $inc . 'footer.php';
