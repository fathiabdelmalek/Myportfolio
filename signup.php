<?php
session_start();
$title = 'Signup';
include 'init.php';
if(isset($_SESSION['user']))
    redirect();
$errors = array(
    'username' => '',
    'email' => '',
    'pass' => ''
);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username   = test_input($_POST['username']);
    $email      = test_input($_POST['email']);
    $password   = sha1(test_input($_POST['password']));
    $pass_pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,}$/';
    $rows = selectRecords('username, email, password', 'users');
    foreach($rows as $row) {
        if($row['username'] == $username) {
            $errors['username'] = 'this name is already used';
        }
        if($row['email'] == $email) {
            $errors['email'] = 'this email is already used';
        }
    }
//    if(!preg_match($pass_pattern, $password))
//        $errors['pass'] = "This password is weak";
    if(($errors['username'] == '' && $errors['email'] == '') && ($errors['pass'] == '')) {
        $sql = $con->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $sql->execute(array($username, $email, sha1($password)));
        $_SESSION['user'] = $username;
        redirect();
    }
}
?>
<article id="article" class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg mt-4">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Register new User</h3>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input required class="form-control" type="text" name="username" placeholder="Username">
                            <span class="alert-sm alert-danger"><?php echo $errors['username']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Email address</label>
                            <input required class="form-control" type="email" name="email" placeholder="Email">
                            <span class="alert-sm alert-danger"><?php echo $errors['email']; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input required class="form-control" type="password" name="password" placeholder="Password">
                            <span class="alert-sm alert-danger"><?php echo $errors['pass']; ?></span>
                        </div><br>
                        <button class="container-fluid btn btn-primary" type="submit">Signup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
<?php include $inc . 'footer.php';
