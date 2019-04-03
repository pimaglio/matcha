<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-06
 * Time: 17:37
 */

include('../models/UsersModel.php');
if (!$_SESSION['loggued_on_user'])
    header("Location: ../index.php");
if (!isset($_SESSION)) {
    session_start();
}

//      INSCRIPTION


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

if (isset($_POST['forgot']) && $_POST['forgot'] == 'ok') {
    $spe = "!#$%+?@";
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $newpass = substr(str_shuffle($chars), 0, 6);
    $newpass .= substr(str_shuffle($spe), 0, 1);
    $password = hash('sha256', $newpass);
    $new_user = new account(array(
        'login' => htmlspecialchars($_POST['login']),
        'password' => htmlspecialchars($password)
    ));
    $var = $new_user->ifLoginTaken();
    if ($var !== 1) {
        $_SESSION['alert'] = 'error';
        header('Location: ../view/reset.php');
        exit();
    } else {
        $new_user->passMail($newpass);
        $_SESSION['alert'] = 'success';
        header('Location: ../view/reset.php');
    }
}

if ($_POST['submit'] == 'editprofil') {
    var_dump($_POST);
    $login_current = $_SESSION['loggued_on_user'];
    $spechar = lowpassword();
    if (!empty($_POST['password'])) {
        $spechar = lowpassword();
        if ($spechar == 5) {
            $_SESSION['alert'] = 5;
            header('Location: ../view/account.php');
            exit();
        }
        if (lowpassword() == 1) {
            $_SESSION['alert'] = 4;
            header('Location: ../view/account.php');
            exit();
        }
        $password = hash('sha256', $_POST['password']);
        $new_user = new account(array(
            'password' => $password
        ));
        $var = $new_user->UpPass($login_current);
    }
    if (!empty($_POST['login'])) {
        if (strlen($_POST['login']) > 25){
            $_SESSION['alert'] = 8;
            header('Location: ../view/account.php');
            exit();
        }
        $new_user = new account(array(
            'login' => htmlspecialchars($_POST['login'])
        ));
        $var = $new_user->UpLogin($login_current);
        if ($var)
            $_SESSION['loggued_on_user'] = htmlspecialchars($_POST['login']);
    }
    if (!empty($_POST['email'])) {
        $new_user = new account(array(
            'email' => $_POST['email']
        ));
        $var = $new_user->UpEmail($login_current);
    }
    if (!empty($_POST['notif'])) {
        if ($_POST['notif'] === 'yes')
            $notif = NULL;
        else
            $notif = 1;
        $new_user = new account(array(
            'login' => $_SESSION['loggued_on_user'],
            'notif' => $notif
        ));
        $var = $new_user->UpNotif();
    }
        header('Location: ../view/account.php');
        exit();
}

if ($_POST['submit'] == 'Register') {
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

//      CONNEXION

if ($_POST['submit'] == 'Login' && isset($_POST['passwd']) && isset($_POST['login'])) {
    $password = hash('sha256', $_POST['passwd']);
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
        header("Location: ../view/home.php");
    }
}
