  <?php
session_start();
$title = 'Dashboard';
include 'init.php';

if (!isset($_SESSION['user']))
    header('location: index.php');
$count = countItems('users');
$users = getLatest('id, username, dateJoined', 'users', 'dateJoined', 6);
?>
<h1 class="text-center">DashBoard</h1>
<div class="container text-center home-stats">
    <div class="row">
        <div class="col-md-4">
            <div class="stats">
                Total Users
                <span><?php echo $count ?></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats">
                Total Portfolios
                <span>430</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats">
                Total Communts
                <span>3400</span>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-users"></i> Recently Users
                </div>
                <div class="card-body">
                    <?php foreach($users as $user) { ?>
                        <ul class="row list-unstyled latest">
                            <li class="col-sm-3">
                                <a href="profile.php?id=<?php echo $user['id']; ?>">
                                    <?php echo $user['username'] ?>
                                </a>
                            </li>
                            <li class="col-sm-3">
                                <?php echo $user['dateJoined'] ?>
                            </li>
                            <li class="col-sm-6">
                                <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-success" role="button">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger confirm-delete" role="button" method="POST">
                                    <i class="fa fa-close"></i> Delete
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-book"></i> Recently Portfolios
                </div>
                <div class="card-body">
                    Test
                </div>
            </div>
        </div>
    </div>
</div>
<?php include $inc . 'footer.php';
