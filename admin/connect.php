<?php
    
    $dsn = 'mysql:host=localhost;dbname=myportfolio';
    $user = 'fathi';
    $pass = '2001';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    try {
        $con = new PDO($dsn, $user, $pass, $options);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e) {
        echo 'Failed to connect to database<br>' . $e->getMessage();
    }
