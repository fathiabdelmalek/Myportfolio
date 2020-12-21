<?php
session_start();
$title = 'Users Manage';
include 'init.php';
if(!isset($_SESSION['user']))
    redirect(1);
$rows = selectRecords('*', 'users', 'id!=1');
?>
<h1 class="text-center">Users Management</h1>
<div class="container">
  <a href="add.php" class="btn btn-primary"><i class="fa fa-plus"></i> New User</a><br><br>
    <div class="table-responsive">
        <table class="main-table table table-bordered text-center">
            <tr>
                <th>#ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Join Date</th>
                <th>Actions</th>
            </tr>
            <?php foreach($rows as $row) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td>
                    <a href="profile.php?username=<?php echo $row['username']; ?>">
                        <?php echo $row['username']; ?>
                    </a>
                </td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['join_date']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info" role="button">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger confirm-delete" role="button">
                       <i class="fa fa-close"></i> Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
<?php include $inc . 'footer.php';
