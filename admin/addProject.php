<?php
session_start();
$title = 'Add new project';
include 'init.php';
if(!isset($_SESSION['user']))
    redirect();
$errors = array(
    'name'          => '',
    'description'   => '',
    'category'      => '',
    'user'          => ''
);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name           = test_input($_POST['name']);
    $description    = test_input($_POST['description']);
    $category       = test_input($_POST['category']);
    $user           = test_input($_POST['user']);
    $visibility     = test_input($_POST['visibility']);
    if(empty($name))
        $errors['name'] = 'Name can\'t be empty';
    if(empty($description))
        $errors['description'] = 'Description can\'t be empty';
    if(empty($category))
        $errors['category'] = 'Category can\'t be empty';
    if(empty($user))
        $errors['user'] = 'User can\'t be empty';
    if(empty($errors['name']) && empty($errors['description']) && empty($errors['category']) && empty($errors['user'])) {
        insertRecored('projects',
                    'name, description, visibility, user_id, category_id',
                    "'$name', '$description', '$visibility', '$user', '$category'");
        redirect('projects.php');
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
                            <input  class="form-control" type="text" name="name" placeholder="Project Name">
                            <span class="alert-sm alert-danger"><?php echo $errors['name']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea  class="form-control" name="description" placeholder="Description"></textarea>
                            <span class="alert-sm alert-danger"><?php echo $errors['description']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Category</label><br>
                            <select required="required" name="category">
                                <option selected value="0">...</option>
                                <?php
                                $sql = $con->prepare("SELECT * FROM `categories`");
                                $sql->execute();
                                $rows = $sql->fetchAll();
                                foreach ($rows as $row)
                                    echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                                ?>
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
                                foreach ($rows as $row)
                                    echo '<option value="' . $row['id'] . '">' . $row['username'] . '</option>';
                                ?>
                            </select>
                            <span class="alert-sm alert-danger"><?php echo $errors['user']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Visibility</label>
                            <div class="form-check">
                                <span>
                                    <input checked id="visibilityy" type="radio" name="visibility" value="1">
                                    <label for="visibilityy">Public</label>
                                </span>
                                <span>
                                    <input id="visibilityn" type="radio" name="visibility" value="0">
                                    <label for="visibilityn">Private</label>
                                </span>
                            </div>
                        </div><br>
                        <button class="container-fluid btn btn-primary" type="submit">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
<?php include $inc . 'footer.php';
