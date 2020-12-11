<?php
session_start();
$title = 'Users Manage';
include 'init.php';

$sql = $con->prepare("SELECT * FROM users WHERE id != 1");
$sql->execute();
$rows = $sql->fetchAll();
?>
<h1 class="text-center">Users Manage</h1>
<div class="container">
    <div class="table-responsive">
        <table class="main-table table table-bordered text-center">
            <tr>
                <th>#ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Joined Data</th>
                <th>Actions</th>
            </tr>
            <?php foreach($rows as $row) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo ''; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger confirm-delete"><i class="fa fa-close">
                        </i>Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    <a href="add.php" class="btn btn-primary"><i class="fa fa-plus"></i> New User</a>
    </div>
</div>
<?php include $inc . 'footer.php';
