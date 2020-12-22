<?php
session_start();
$title = 'Categories Manage';
include 'init.php';
if(!isset($_SESSION['user']))
    redirect();
$arr = array('ASC', 'DESC');
$sort = (isset($_GET['sort']) && in_array($_GET['sort'], $arr)) ? test_input($_GET['sort']) : 'ASC';
$rows = selectRecords('*', 'categories', null, 'id', $sort);
?>
<h1 class="text-center">Categories Management</h1>
<div class="container cats">
    <?php if (isset($_GET['message'])) echo '<div class="alert alert-warning">' . $_GET['message'] . '</div>'; ?>
    <a href="addCategory.php" class="btn btn-primary"><i class="fa fa-plus"></i> New Category</a><br><br>
    <div class="card">
        <div class="card-header">
            Categories
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
                There is no categories
            <?php } else { foreach($rows as $row) { ?>
                <div class="cat">
                    <div class="hidden-btn">
                        <a class="btn btn-sm btn-info" href="editCategory.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i>Edit</a>
                        <a class="btn btn-sm btn-danger confirm-delete" href="deleteCategory.php?id=<?php echo $row['id'] ?>"><i class="fa fa-close"></i>Delete</a>
                    </div>
                    <h3><?php echo $row['title'] ?></h3>
                    <div class="view">
                        <p>
                            <?php echo $row['description'] ?>
                        </p>
                        <span class="<?php if($row['comments'] == 1) echo 'enabled'; else echo 'disabled'; ?>">
                            Comments is <?php if($row['comments'] == 1) echo 'Enabled'; else echo 'Disabled'; ?>
                        </span>
                        <span class="<?php if($row['ads'] == 1) echo 'enabled'; else echo 'disabled'; ?>">
                            Ads is <?php if($row['ads'] == 1) echo 'Enabled'; else echo 'Disabled'; ?>
                        </span>
                        <?php if($row['visibility'] == 0) { ?>
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
