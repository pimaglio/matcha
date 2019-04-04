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

//var_dump ($_POST);

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

// INSERT TABLE DATA

if (isset($_POST['createprofile']) && $_POST['createprofile'] === 'ok' && isset($_POST['sexe']) && isset($_POST['age'])
    && isset($_POST['location']) && isset($_POST['orientation']) && isset($_POST['bio'])) {
    $arr = [];
    if (($b = htmlspecialchars($_POST['bio'])) !== $_POST['bio'] ||
        ($l = htmlspecialchars($_POST['location'])) !== $_POST['location']) {
        $_SESSION['alert'] = 's';
        header('Location: ../view/createprofile.php');
        exit();
    } else {
        $arr['sexe'] = $_POST['sexe'];
        $arr['age'] = $_POST['age'];
        $arr['location'] = $_POST['location'];
        $arr['orientation'] = $_POST['orientation'];
        $arr['bio'] = $_POST['bio'];
        $db_con = new infos($arr);
        $db_con->add_data();
        $inte = [];
        foreach ($_POST as $k => $v){
            if ($v == 101)
                $inte[$k] = $v;
        }
        $db_con->add_interest($inte);
//        header("Location: ../view");
    }
}

// CREATION DU COMPTE

if (isset($_POST['register']) && $_POST['register'] === 'ok' && isset($_POST['login'])
    && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['password'])
    && isset($_POST['password2'])) {
    if (htmlspecialchars($_POST['nom']) !== $_POST['nom'] || htmlspecialchars($_POST['login'])
        !== $_POST['login'] || htmlspecialchars($_POST['email']) !== $_POST['email']) {
        $_SESSION['alert'] = 's';
        header('Location: ../view/register.php');
        exit();
    }
    if (strlen($_POST['login']) > 25) {
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
        'login' => $_POST['login'],
        'nom' => $_POST['nom'],
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
        header('Location: ../');
    }
}

// CONNEXION

if (isset ($_POST['connec']) && $_POST['connec'] === 'ok' && isset($_POST['password'])
    && isset($_POST['login'])) {
    if (htmlspecialchars($_POST['login']) !== $_POST['login']){
        $_SESSION['alert'] = 's';
        header('Location: ../view/login.php');
        exit();
    }
    $password = hash('sha256', $_POST['password']);
    $user = New account(array(
        'password' => $password,
        'login' => $_POST['login']
    ));
    $var = $user->Connect();
    if ($var === 1) {
        $_SESSION['alert'] = "Ce compte n'existe pas";
        header("Location: ../view/login.php");
        exit();
    }
    if ($var === 2) {
        $_SESSION['alert'] = "Vous devez activer votre compte";
        header("Location: ../view/login.php");
        exit();
    }
    if ($var === 3) {
        $_SESSION['alert'] = "Mot de passe erroné";
        header("Location: ../view/login.php");
    } else {
        $_SESSION['alert'] = "success";
        header("Location: ../view/");
    }
}


// MDP OUBLIE

if (isset($_POST['forgot']) && $_POST['forgot'] === 'ok' && isset($_POST['login'])){
    if (htmlspecialchars($_POST['login']) !== $_POST['login']){
        $_SESSION['alert'] = 's';
        header('Location: ../view/reset.php');
        exit();
    }
    $spe = "!#$%+?@";
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $newpass = substr(str_shuffle($chars), 0, 6);
    $newpass .= substr(str_shuffle($spe), 0, 1);
    $password = hash('sha256', $newpass);
    $new_user = new account(array(
        'login' => $_POST['login'],
        'password' => $password
    ));
    $var = $new_user->ifLoginTaken();
    if ($var !== 1) {
        $_SESSION['alert'] = 'error';
        header('Location: ../view/reset.php');
        exit();
    } else {
        $new_user->passMail($newpass);
        unset($_SESSION['alert']);
        $_SESSION['alert'] = 'success';
        header('Location: ../view/login.php');
    }
}