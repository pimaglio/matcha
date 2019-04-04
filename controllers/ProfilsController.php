<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-04
 * Time: 15:05
 */
include('../models/UsersModel2.php');
if (!isset($_SESSION)) {
    session_start();
}

if ($_POST['createprofile'] === 'ok' && isset($_POST['sexe']) && isset($_POST['age'])
        && isset($_POST['location']) && isset($_POST['orientation']) && isset($_POST['bio'])) {
    $arr = [];
    $arr['sexe'] = htmlspecialchars($_POST['sexe']);
    $arr['age'] = htmlspecialchars($_POST['age']);
    $arr['location'] = htmlspecialchars($_POST['location']);
    $arr['orientation'] = htmlspecialchars($_POST['orientation']);
    $arr['bio'] = htmlspecialchars($_POST['bio']);
    $db_con = new infos($arr);
    $db_con->add_data();
    header("Location: ../view");
}