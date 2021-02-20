<?php
session_start();
include 'init.php';
$title = isset($_GET['username']) ? $_GET['username'] : $user;
$arr = array('ASC', 'DESC');
$sort = (isset($_GET['sort']) && in_array($_GET['sort'], $arr)) ? test_input($_GET['sort']) : 'ASC';
$sql = $con->prepare("SELECT * FROM users WHERE username=:username");
$sql->bindParam('username', $title);
$sql->execute();
$row = $sql->fetch();
$id = $row['id'];
$projects = selectRecords("*", "projects_view", "user_id=$id");
?>
<h1 class="text-center">Profile Page</h1>
<div class="information">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>User Informations</h2>
            </div>
            <div class="card-body">
                <ul>
                    <li><span>Username</span> : <?php echo $row['username'] ?></li>
                    <li><span>Email</span> : <?php echo $row['email'] ?></li>
                    <li><span>Full name</span> : <?php echo $row['full_name'] ?></li>
                </ul>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                User Projects
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
                <?php if(empty($projects)) { ?>
                    There is no projects
                <?php } else foreach($projects as $project) { ?>
                    <div class="cat">
                        <div class="card">
                            <div class="card-header">
                                <span class="toggle-info pull-right">
                                    <i class="fa fa-arrow-up"></i>
                                </span>
                                <div class="hidden-btn">
                                    <a class="btn btn-sm btn-info" href="editProject.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i>Edit</a>
                                    <a class="btn btn-sm btn-danger confirm-delete" href="deleteProject.php?id=<?php echo $row['id'] ?>"><i class="fa fa-close"></i>Delete</a>
                                </div>
                                <img class="pull-left" src="icon.png" alt="user image" width="35" height="35">
                                <a href="project.php?name=<?php echo $project['name'] ?>">
                                    <h3><?php echo $project['name'] ?></h3>
                                </a>
                                <span class="pull-right"><b>Add Date:</b> <?php echo $project['add_date'] ?></span>
                            </div>
                            <div class="card-body">
                                <div class="view p-3 pb-2">
                                    <p><?php echo $project['description'] ?></p>
                                    <span class="<?php if($project['visibility'] == 1) echo 'enabled'; else echo 'disabled'; ?>">
                                        <?php if($project['visibility'] == 1) echo 'Public'; else echo 'Private'; ?>
                                    </span>
                                    <span><b>Category:</b> <?php echo $project['category_title'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php } ?>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h2>User Comments</h2>
            </div>
            <div class="card-body">
                <?php echo 'comments' ?>
            </div>
        </div>
    </div>
</div>
<?php include $inc . 'footer.php';
