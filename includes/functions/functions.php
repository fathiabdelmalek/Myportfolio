<?php

function splite_array ($arr) {
    $set = '';
    foreach ($arr as $col) {
        $set .= "$col=?";
        if ($col != end($arr))
            $set .= ', ';
    }
    return $set;
}

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

function redirect($url = null) {
    if($url === null) {
        $url = 'index.php';
    }
    else if($url === 'back') {
        $url = (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') ? $_SERVER['HTTP_REFERER'] : 'index.php';
    }
    header("location:$url");
    exit();
}

function selectRecords($select, $table, $value = null, $ordering = null, $sorting = null) {
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

function insertRecored ($table, $cols, $values) {
    global $con;
    $sql = $con->prepare("INSERT INTO $table ($cols) VALUES ($values)");
    $sql->execute();
}

function updateRecord ($table, $cols, $values, $condition) {
    global $con;
    $set = splite_array($cols);
    $sql = $con->prepare("UPDATE $table SET $set WHERE $condition");
    $sql->execute($values);
}

function deleteRecord($table, $selects, $values) {
    global $con;
    $cols = splite_array($selects);
    $sql = $con->prepare("DELETE FROM $table WHERE $cols");
    $sql->execute($values);
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
