<?php
session_start();
$title = 'Projects Manage';
include 'init.php';
$sort = 'ASC';
?>
<h1 class="text-center">Projects Manager</h1>
<div class="container cats">
    <a href="addProject.php" class="btn btn-primary"><i class="fa fa-plus"></i> New Project</a><br><br>
    <div class="card">
        <div class="card-header">
            Projects
            <div class="options pull-right">
                <i class="fa fa-sort"></i> Ordering: [
                <a <?php if($sort == 'ASC') { echo 'class="active"'; } ?> href="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>?sort=ASC"><i class="fa fa-sort-alpha-asc"></i></a> |
                <a <?php if($sort == 'DESC') { echo 'class="active"'; } ?> href="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>?sort=DESC"><i class="fa fa-sort-alpha-desc"></i></a>]
                View: [
                <span class="active" data-view="full">Full</span> |
                <span>Classic</span>]
            </div>
        </div>
        <div class="card-body">
            <?php if(empty($rows)) { ?>
                There is no categories
            <?php } else { foreach($rows as $row) { ?>
                <div class="cat">
                    <div class="hidden-btn">
                        <a class="btn btn-success" href="editCategory.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i>Edit</a>
                        <a class="btn btn-danger" href="deleteCategory.php?id=<?php echo $row['id'] ?>"><i class="fa fa-close"></i>Delete</a>
                    </div>
                    <h3><?php echo $row['title'] ?></h3>
                    <div class="view">
                        <p>
                            <?php
                            if($row['description'] == '')
                                echo 'This category has no description';
                            else
                                echo $row['description'];
                            ?>
                        </p>
                        <span class="<?php if($row['comments'] == 1) echo 'enabled'; else echo 'disabled'; ?>">
                        Comments is <?php if($row['comments'] == 1) echo 'Enabled'; else echo 'Disabled'; ?>
                    </span>
                        <span class="<?php if($row['ads'] == 1) echo 'enabled'; else echo 'disabled'; ?>">
                        Ads is <?php if($row['ads'] == 1) echo 'Enabled'; else echo 'Disabled'; ?>
                    </span>
                        <?php if($row['hidden'] == 1) { ?>
                            <span class="hidden"><i class="fa fa-eye-slash"></i> Hidden</span>
                        <?php } ?>
                    </div>
                </div>
                <hr>
            <?php }} ?>
        </div>
    </div>
</div>
<?php include $inc . 'footer.php';
