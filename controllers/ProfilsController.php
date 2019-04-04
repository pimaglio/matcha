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

var_dump ($_POST);

function lowpassword()
{
    $cl = strlen($_POST['password']);
    $spechar = 5;
    if ($cl < 6)
        return 1;
    else if (!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $_POST['password']))
        return $spechar;
    else
        return 0;
}

if (isset($_POST['createprofile']) && $_POST['createprofile'] === 'ok' && isset($_POST['sexe']) && isset($_POST['age'])
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

if (isset($_POST['register']) && $_POST['register'] === 'ok'){
    echo 'ok';
    if (strlen($_POST['login']) > 25){
        $_SESSION['alert'] = 8;
        header('Location: ../view/register.php');
        exit();
    }

    if ($_POST['password'] !== $_POST['password2']) {
        $_SESSION['alert'] = 7;
        header('Location: ../view/register.php');
        exit();
    }
    $spechar = lowpassword();
    if ($spechar == 5) {
        $_SESSION['alert'] = 5;
        header('Location: ../view/register.php');
        exit();
    }
    if (lowpassword() == 1) {
        $_SESSION['alert'] = 4;
        header('Location: ../view/register.php');
        exit();
    }
    $password = hash('sha256', $_POST['password']);
    $new_user = new account(array(
        'login' => htmlspecialchars($_POST['login']),
        'password' => $password,
        'email' => $_POST['email'],
    ));
    $var = $new_user->add();
    if ($var === 1) {
        header('Location: ../view/register.php');
        exit();
    } else {
        $new_user->sendMail();
        $_SESSION['alert'] = 2;
    }
}