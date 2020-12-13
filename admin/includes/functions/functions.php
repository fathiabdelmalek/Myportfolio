<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function setTitle() {
    global $title;
    if(isset($title))
        echo $title . ' | Myportfolio';
    else
        echo 'Myportfolio';
}

function redirect($seconds = 3, $url = null) {
    if($url === null) {
        $url = 'index.php';
    }
    else if($url === 'back') {
        $url = (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') ? $_SERVER['HTTP_REFERER'] : 'index.php';
    }
    header("refresh:$seconds;url=$url");
    exit();
}

function countItems($table) {
    global $con;
    $sql = $con->prepare("SELECT COUNT(id) FROM $table");
    $sql->execute();
    return $sql->fetchColumn();
}

function getLatest($cols, $table, $order, $limit = 5) {
    global $con;
    $sql = $con->prepare("SELECT $cols FROM $table ORDER BY $order DESC LIMIT $limit");
    $sql->execute();
    return $sql->fetchAll();
}