<?php
session_start();
$title = 'Categories Manage';
include 'init.php';
if(!isset($_SESSION['user']))
    redirect(1);
$arr = array('ASC', 'DESC');
$sort = (isset($_GET['sort']) && in_array($_GET['sort'], $arr)) ? test_input($_GET['sort']) : 'ASC';
$rows = selectItems('*', 'categories', null, 'ordering', $sort);
//$sql = $con->prepare("SELECT * FROM categories");
?>
<h1 class="text-center">Categories Management</h1>
<div class="container cats">
    <a href="addCategory.php" class="btn btn-primary"><i class="fa fa-plus"></i> New Category</a><br><br>
    <div class="card">
        <div class="card-header">
            Categories
            <div class="ordering pull-right">
                Ordering:
                <a <?php if($sort == 'ASC') { echo 'class="active"'; } ?> href="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>?sort=ASC">ASC</a> |
                <a <?php if($sort == 'DESC') { echo 'class="active"active'; } ?> href="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>?sort=DESC">DESC</a>
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
                    <p>
                        <?php
                        if($row['description'] == '')
                            echo 'This category has no description';
                        else
                            echo $row['description'];
                        ?>
                    </p>
                    <?php if($row['hidden'] == 0) { ?>
                        <span class="hidden">Hidden</span>
                    <?php } ?>
                    <?php if($row['comments'] == 1) { ?>
                        <span class="comments">Comments is on</span>
                    <?php } ?>
                    <?php if($row['ads'] == 1) { ?>
                        <span class="ads">Ads in on</span>
                    <?php } ?>
                </div>
                <hr>
            <?php }} ?>
        </div>
    </div>
</div>
<?php include $inc . 'footer.php';
