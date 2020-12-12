
<?php
session_start();
$title = 'Dashboard';
include 'init.php';

if (!isset($_SESSION['user']))
    header('location: index.php');
$count = countItems('users');
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
                    Test
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
