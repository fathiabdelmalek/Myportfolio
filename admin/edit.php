<?php
session_start();
$title = 'Edit page';
include 'init.php';
if(!isset($_SESSION['user']))
    redirect();
$errors = array(
    'name' => '',
    'email' => '',
    'pass' => ''
);
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$sql = $con->prepare("SELECT * FROM users WHERE id=:id");
$sql->bindParam('id', $id);
$sql->execute();
$row = $sql->fetch();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username   = test_input($_POST['username']);
    $email      = test_input($_POST['email']);
    $oldpass    = $row['password'];
    $password   = test_input($_POST['password']);
    $sha1 = (!empty($_POST['password'])) ? sha1($password) : $oldpass;
    $passPattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,}$/';
    if(!preg_match("/^[a-zA-Z0-9_']*$/", $username))
        $errors['name'] = "Only letters and numbers and underscore";
    else {
        $sql = $con->prepare("SELECT * FROM users WHERE username=:username");
        $sql->execute(array('username'=>$username));
        if($sql->rowCount() > 1)
            $errors['name'] = "This username is already used";
    }
    $sql = $con->prepare("SELECT * FROM users WHERE email=:email");
    $sql->bindParam(':email', $email);
    $sql->execute();
    if($sql->rowCount() > 1)
        $errors['email'] = 'This Email domain name is alredy used';
    if(!preg_match($passPattern, $password))
        $errors['pass1'] = "Weak Password";
    if(empty($errors['name']) && empty($errors['email']) && empty($errors['pass'])) {
        updateRecord('users',
                    ['username', 'email', 'password'],
                    [$username, $email, $sha1],
            "id=$id");
        redirect("edit.php?id=$id");
    }
}
?>
<article id="article" class="container" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-4">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Edit User</h3>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="form-group">
                            <label>User name</label>
                            <input required class="form-control" type="text" name="username" value="<?php echo $row['username']; ?>">
                            <span class="alert-sm alert-danger"><?php echo $errors['name']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label>Email address</label>
                            <input required class="form-control" type="email" name="email" value="<?php echo $row['email']; ?>">
                            <span class="alert-sm alert-danger"><?php echo $errors['email']; ?></span>
                        </div><br>
                        <input type="hidden" value="<?php echo $row['password']; ?>">
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Leave blank if you don't want to change">
                            <span class="alert-sm alert-danger"><?php echo $errors['pass']; ?></span>
                        </div><br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
<?php include $inc . 'footer.php';
