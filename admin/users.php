<?php
session_start();
if(!isset($_SESSION['user']))
    redirect();
$title = 'Users Manage';
include 'init.php';
$arr = array('ASC', 'DESC');
$sort = (isset($_GET['sort']) && in_array($_GET['sort'], $arr)) ? test_input($_GET['sort']) : 'ASC';
$rows = selectRecords('*', 'users', 'id!=1', 'id', $sort);
?>
<h1 class="text-center">Users Management</h1>
<div class="container cats">
    <?php if (isset($_GET['message'])) echo '<div class="alert alert-warning">' . $_GET['message'] . '</div>'; ?>
    <a href="add.php" class="btn btn-primary"><i class="fa fa-plus"></i> New User</a><br><br>
<!--    <div class="table-responsive">-->
<!--        <table class="main-table table table-bordered text-center">-->
<!--            <tr>-->
<!--                <th>#ID</th>-->
<!--                <th>Username</th>-->
<!--                <th>Email</th>-->
<!--                <th>Join Date</th>-->
<!--                <th>Actions</th>-->
<!--            </tr>-->
<!--            --><?php //foreach($rows as $row) { ?>
<!--            <tr>-->
<!--                <td>--><?php //echo $row['id']; ?><!--</td>-->
<!--                <td>-->
<!--                    <a href="profile.php?username=--><?php //echo $row['username']; ?><!--">-->
<!--                        --><?php //echo $row['username']; ?>
<!--                    </a>-->
<!--                </td>-->
<!--                <td>--><?php //echo $row['email']; ?><!--</td>-->
<!--                <td>--><?php //echo $row['join_date']; ?><!--</td>-->
<!--                <td>-->
<!--                    <a href="edit.php?id=--><?php //echo $row['id']; ?><!--" class="btn btn-sm btn-info" role="button">-->
<!--                        <i class="fa fa-edit"></i> Edit-->
<!--                    </a>-->
<!--                    <a href="delete.php?id=--><?php //echo $row['id']; ?><!--" class="btn btn-sm btn-danger confirm-delete" role="button">-->
<!--                       <i class="fa fa-close"></i> Delete-->
<!--                    </a>-->
<!--                </td>-->
<!--            </tr>-->
<!--            --><?php //} ?>
<!--        </table>-->
<!--    </div>-->
    <div class="card">
        <div class="card-header">
            Users
            <div class="options pull-right">
                <i class="fa fa-sort"></i> Ordering: [
                <a <?php if($sort == 'ASC') echo 'class="active"'; ?> href="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>?sort=ASC"><i class="fa fa-sort-alpha-asc"></i></a> |
                <a <?php if($sort == 'DESC') echo 'class="active"'; ?> href="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>?sort=DESC"><i class="fa fa-sort-alpha-desc"></i></a>]
                View: [
                <span class="active" data-view="full">Full</span> |
                <span>Classic</span>]
            </div>
        </div>
        <div class="card-body">
            <?php if(empty($rows)) { ?>
                There is no users
            <?php } else { foreach($rows as $row) { ?>
                <div class="cat">
                    <div class="hidden-btn">
                        <a class="btn btn-sm btn-info" href="edit.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i>Edit</a>
                        <a class="btn btn-sm btn-danger confirm-delete" href="delete.php?id=<?php echo $row['id'] ?>"><i class="fa fa-close"></i>Delete</a>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            IMAGE
                        </div>
                        <div class="col-10">
                            <h3><?php echo $row['username'] ?></h3>
                            <div class="view">
                                <p><?php echo $row['email'] ?></p>
                                <span class="pull-right"><b>Join Date:</b> <?php echo $row['join_date'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            <?php }} ?>
        </div>
    </div>
</div>
<?php include $inc . 'footer.php';
