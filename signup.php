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
?>
<article id="article" class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg mt-4">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">User Login</h3>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
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
                        <button class="container-fluid btn btn-primary" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
<?php include $inc . 'footer.php';
