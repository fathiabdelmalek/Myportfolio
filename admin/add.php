<?php
session_start();
$title = 'Add new User';
include 'init.php';
if(!isset($_SESSION['user']))
    redirect(1);
$errors = array(
    'name'  => '',
    'email' => '',
    'pass1' => '',
    'pass2' => ''
);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username   = test_input($_POST['username']);
    $email      = test_input($_POST['email']);
    $password1   = test_input($_POST['password1']);
    $password2   = test_input($_POST['password2']);
    $sha1 = sha1($password1);
    $passPattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,}$/';
    if(!preg_match("/^[a-zA-Z0-9_']*$/", $username))
        $errors['name'] = "Only letters and numbers and underscore";
    else {
        $sql = $con->prepare("SELECT * FROM users WHERE username=:username");
        $sql->execute(array('username'=>$username));
        if($sql->rowCount() > 0)
            $errors['name'] = "This username is alredy used";
    }
    $sql = $con->prepare("SELECT * FROM users WHERE email=:email");
    $sql->bindParam(':email', $email);
    $sql->execute();
    if($sql->rowCount() > 0)
        $errors['email'] = 'This Email domain name is alredy used';
    if(!preg_match($passPattern, $password1))
            $errors['pass1'] = "Weak Password";
    if($password2 != $password1)
        $errors['pass2'] = "Must be the same as Password";
    if(empty($errors['name']) && empty($errors['email']) && empty($errors['pass1']) && empty($errors['pass2'])) {
        $sql = $con->prepare("INSERT INTO users (username, email, password, dateJoined)
                                VALUE (:username, :email, :password, now())");
        $sql->bindParam('username', $username);
        $sql->bindParam('email', $email);
        $sql->bindParam('password', $sha1);
        $sql->execute();
        header('location: users.php');
        exit();
    }
}
?>
<article id="article" class="container" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-4">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Add New User</h3>
                </div>
                <div class="card-body">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label>User name</label>
                            <input required class="form-control" type="text" name="username" placeholder="Username">
                            <span class="alert-sm alert-danger"><?php echo $errors['name']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label>Email address</label>
                            <input required class="form-control" type="email" name="email" placeholder="Email">
                            <span class="alert-sm alert-danger"><?php echo $errors['email']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label>Password</label>
                            <input required class="form-control" type="password" name="password1" placeholder="Password">
                            <span class="alert-sm alert-danger"><?php echo $errors['pass1']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input required class="form-control" type="password" name="password2" placeholder="Password">
                            <span class="alert-sm alert-danger"><?php echo $errors['pass2']; ?></span>
                        </div><br>
                        <button class="btn btn-primary" type="submit">Add new user</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
<?php include $inc . 'footer.php';
