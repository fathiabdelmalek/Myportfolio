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
    elseif($url = 'back') {
        $url = (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') ? $_SERVER['HTTP_REFERER'] : 'index.php';
    }
    header("refresh:$seconds;url=$url");
    exit();
}
