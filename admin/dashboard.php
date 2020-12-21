<?php
session_start();
$title = 'Dashboard';
include 'init.php';

if (!isset($_SESSION['user']))
    header('location: index.php');
$users      = countItems('id', 'users');
$categories = countItems('id', 'categories');
$projects   = countItems('id', 'projects');
$comments   = countItems('id', 'comments');
$users_latest       = getLatest('id, username, join_date', 'users', 'join_date', 6);
$projects_latest    = getLatest('id, name, add_date, username, category_title', 'projects_view', 'add_date', 6);
?>
<h1 class="text-center">DashBoard</h1>
<div class="container text-center home-stats">
    <div class="row">
        <div class="col-md-3">
            <div class="stats">
                Total Users
                <span><?php echo $users ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats">
                Total Categories
                <span><?php echo $categories ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats">
                Total Portfolios
                <span><?php echo $projects ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats">
                Total Communts
                <span><?php echo $comments ?></span>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-users"></i> Recently Registered Users
                    <span class="toggle-info pull-right">
                        <i class="fa fa-arrow-up"></i>
                    </span>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled latest">
                        <?php foreach ($users_latest as $user) { ?>
                            <li>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <a href="profile.php?username=<?php echo $user['username']; ?>">
                                            <?php echo $user['username'] ?>
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <?php echo $user['join_date'] ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-success" role="button">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger confirm-delete" role="button" method="POST">
                                            <i class="fa fa-close"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-clipboard"></i> Recently Added Projects
                    <span class="toggle-info pull-right">
                        <i class="fa fa-arrow-up"></i>
                    </span>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled latest">
                        <?php foreach ($projects_latest as $project) { ?>
                            <li>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <a href="project.php?name=<?php echo $project['name']; ?>">
                                            <?php echo $project['name'] ?>
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <?php echo $project['add_date'] ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="editProject.php?id=<?php echo $project['id']; ?>" class="btn btn-sm btn-success" role="button">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="deleteProject.php?id=<?php echo $project['id']; ?>" class="btn btn-sm btn-danger confirm-delete" role="button" method="POST">
                                            <i class="fa fa-close"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include $inc . 'footer.php';
