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

function selectItems($select, $table, $value = null, $ordering = null, $sorting = null) {
    global $con;
    $stmt = "SELECT $select FROM $table";
    if(!empty($value))
        $stmt .= " WHERE $value";
    if(!empty($ordering))
        $stmt .= " ORDER BY $ordering";
    if(!empty($sorting))
        $stmt .= " $sorting";
    $sql = $con->prepare($stmt);
    $sql->execute();
    return $sql->fetchAll();
}

function deleteRecord($table, $select, $value) {
    global $con;
    $sql = $con->prepare("DELETE FROM $table WHERE $select=:value");
    $sql->bindParam('value', $value);
    $sql->execute();
}

function countItems($col, $table) {
    global $con;
    $sql = $con->prepare("SELECT COUNT($col) FROM $table");
    $sql->execute();
    return $sql->fetchColumn();
}

function getLatest($cols, $table, $order, $limit = 5) {
    global $con;
    $sql = $con->prepare("SELECT $cols FROM $table ORDER BY $order DESC LIMIT $limit");
    $sql->execute();
    return $sql->fetchAll();
}