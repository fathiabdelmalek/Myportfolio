<?php
session_start();
$title = 'Projects';
include 'init.php';
$arr = array('ASC', 'DESC');
$sort = (isset($_GET['sort']) && in_array($_GET['sort'], $arr)) ? test_input($_GET['sort']) : 'ASC';
$rows = selectRecords('*', 'projects_view', null, 'id', $sort);
?>
    <h1 class="text-center">Projects</h1>
<div class="container cats">
    <?php if (isset($_GET['message'])) echo '<div class="alert alert-warning">' . $_GET['message'] . '</div>'; ?>
    <?php if ($_SESSION['user']) { ?>
        <a href="addProject.php" class="btn btn-primary"><i class="fa fa-plus"></i> New Project</a><br><br>
    <?php } ?>
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
                There is no projects
            <?php } else foreach ($rows as $row) { if ($row['visibility'] == 1) { ?>
            <div class="cat">
                <div class="card">
                    <div class="card-header">
                        <span class="toggle-info pull-right">
                            <i class="fa fa-arrow-up"></i>
                        </span>
                        <?php if ($_SESSION['user'] && $_SESSION['user'] == $row['username']) { ?>
                        <div class="hidden-btn">
                            <a class="btn btn-sm btn-info" href="editProject.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i>Edit</a>
                            <a class="btn btn-sm btn-danger confirm-delete" href="deleteProject.php?id=<?php echo $row['id'] ?>"><i class="fa fa-close"></i>Delete</a>
                        </div>
                        <?php } ?>
                        <img class="pull-left" src="icon.png" alt="user image" width="35" height="35">
                        <a href="project.php?name=<?php echo $row['name'] ?>">
                            <h3><?php echo $row['name'] ?></h3>
                        </a>
                        <span class="pull-right"><b>Add Date:</b> <?php echo $row['add_date'] ?></span>
                    </div>
                    <div class="card-body">
                        <div class="view p-3 pb-2">
                            <p><?php echo $row['description'] ?></p>
                            <span><b>Category:</b> <?php echo $row['category_title'] ?></span> |
                            <span><b>User:</b> <?php echo $row['username'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <?php }} ?>
        </div>
    </div>
</div>
<?php include $inc . 'footer.php' ?>
