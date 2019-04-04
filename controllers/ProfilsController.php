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
var_dump($_POST);
if ($_POST['createprofile'] === 'ok'){
    $arr = [];
    if (isset($_POST['sexe']))
        $arr['sexe'] = htmlspecialchars($_POST['sexe']);
    if (isset($_POST['age']))
        $arr['age'] = htmlspecialchars($_POST['age']);
    if (isset($_POST['location']))
        $arr['location'] = htmlspecialchars($_POST['location']);
    if (isset($_POST['orientation']))
        $arr['orientation'] = htmlspecialchars($_POST['orientation']);
    if (isset($_POST['bio']))
        $arr['bio'] = htmlspecialchars($_POST['bio']);
    $db_con = new infos($arr);
    $db_con->add_data();
}