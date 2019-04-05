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

function htmldump($variable, $height = "300px")
{
    echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
    var_dump($variable);
    echo "</pre>\n";
}

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

function recup_data()
{
    $db_con = new infos($_POST);
    return $db_con->array_data();
}

function recup_inter()
{
    $db_con = new infos($_POST);
    return $db_con->array_inter();
}

function recup_user()
{

}

//$data = recup_data();
//$inter = recup_inter();


// MODIF USER

if (isset($_POST['user_modif']) && $_POST['user_modif'] === 'ok' && isset($_POST['login'])
    && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['nom'])
    && isset($_POST['email'])) {
    $db_con = new account(array(
        'login' => $_SESSION['loggued_on_user']
    ));
    $user = $db_con->array_user();
    echo $_SESSION['loggued_on_user'];
    if (htmlspecialchars($_POST['nom']) !== $_POST['nom'] || htmlspecialchars($_POST['login'])
        !== $_POST['login'] || htmlspecialchars($_POST['email']) !== $_POST['email']) {
        $_SESSION['error'] = 5;
        header('Location: ../view/account.php');
        exit();
    }
    if (!empty($_POST['password']) && !empty($_POST['password2'])) {
        if (strlen($_POST['login']) > 25) {
            $_SESSION['error'] = 1;
            header('Location: ../view/account.php');
            exit();
        }
        if ($_POST['password'] !== $_POST['password2']) {
            $_SESSION['error'] = 2;
            header('Location: ../view/account.php');
            exit();
        }
        $spechar = lowpassword();
        if ($spechar == 5) {
            $_SESSION['error'] = 3;
            header('Location: ../view/account.php');
            exit();
        }
        if (lowpassword() == 1) {
            $_SESSION['error'] = 4;
            header('Location: ../view/account.php');
            exit();
        }
        $password = hash('sha256', $_POST['password']);
    } else
        $password = hash('sha256', $db_con->user_passwd());
    $info = new infos([]);
    $id = $info->find_id();
    $db_con = new account($_POST);
    $_SESSION['modif'] = 1;
    if ($var = $db_con->ifLoginTaken() === 1 && isset($_SESSION['error']) && $_SESSION['error'] === 6 && $_POST['login'] !== $user['login']){
        header('Location: ../view/account.php');
        unset ($_SESSION['modif']);
        exit();
    }
    else if  (($var = $db_con->ifEmailTaken() === 1) && $_POST['email'] !== $user['email']){
        $_SESSION['error'] = 7;
        unset ($_SESSION['modif']);
                header('Location: ../view/account.php');
        exit();
    }
    else {
        $db = new account(array(
            'login' => $_POST['login'],
            'password' => $password,
            'email' => $_POST['email'],
            'nom' => $_POST['nom']
        ));
        $db->edit_profil($id);
        unset($_SESSION['error']);
        unset ($_SESSION['modif']);
        $_SESSION['success'] = 1;
        header('Location: ../view');
    }
}

// MODIF DATA ET INTERET

if (isset($_POST['data_modif']) && $_POST['data_modif'] === 'ok' && isset($_POST['age']) && isset($_POST['location'])
&& isset($_POST['sexe']) && isset($_POST['orientation']) && isset($_POST['bio'])) {
    if (htmlspecialchars($_POST['age']) !== $_POST['age'] || htmlspecialchars($_POST['sexe']) !== $_POST['sexe']
    || htmlspecialchars($_POST['location']) !== $_POST['location'] || htmlspecialchars($_POST['bio']) !== $_POST['bio']){
        $_SESSION['error'] = 5;
        header('Location: ../view/account.php');
        exit();
    }
    $db_con = new infos($_POST);
    $db_con->edit_data();
    $inte = $db_con->array_inter();
    unset($inte['id']);
    unset($inte['id_usr']);
    $inter = [];
    foreach ($_POST as $k => $v) {
        if ($v == 101)
            $inter[$k] = $v;
    }
    $db_con->edit_interest($inte, $inter);
    $_SESSION['succes'] = 1;
    header('Location: ../view/');
}
// INSERT TABLE DATA

if (isset($_POST['createprofile']) && $_POST['createprofile'] === 'ok' && isset($_POST['sexe']) && isset($_POST['age'])
    && isset($_POST['location']) && isset($_POST['orientation']) && isset($_POST['bio'])) {
    $arr = [];
    if (($b = htmlspecialchars($_POST['bio'])) !== $_POST['bio'] ||
        ($l = htmlspecialchars($_POST['location'])) !== $_POST['location']) {
        $_SESSION['error'] = 5;
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
        foreach ($_POST as $k => $v) {
            if ($v == 101)
                $inte[$k] = $v;
        }
        $db_con->add_interest($inte);
        header("Location: ../view");
    }
}

// CREATION DU COMPTE

if (isset($_POST['register']) && $_POST['register'] === 'ok' && isset($_POST['login'])
    && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['password'])
    && isset($_POST['password2'])) {
    if (htmlspecialchars($_POST['nom']) !== $_POST['nom'] || htmlspecialchars($_POST['login'])
        !== $_POST['login'] || htmlspecialchars($_POST['email']) !== $_POST['email']) {
        $_SESSION['error'] = 5;
        header('Location: ../view/register.php');
        exit();
    }
    if (strlen($_POST['login']) > 25) {
        $_SESSION['error'] = 1;
        header('Location: ../view/register.php');
        exit();
    }
    if ($_POST['password'] !== $_POST['password2']) {
        $_SESSION['error'] = 2;
        header('Location: ../view/register.php');
        exit();
    }
    $spechar = lowpassword();
    if ($spechar == 5) {
        $_SESSION['error'] = 3;
        header('Location: ../view/register.php');
        exit();
    }
    if (lowpassword() == 1) {
        $_SESSION['error'] = 4;
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
        $_SESSION['succes'] = 2;
        header('Location: ../');
    }
}

// CONNEXION

if (isset ($_POST['connec']) && $_POST['connec'] === 'ok' && isset($_POST['password'])
    && isset($_POST['login'])) {
    if (htmlspecialchars($_POST['login']) !== $_POST['login']) {
        $_SESSION['error'] = 5;
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
        $_SESSION['error'] = 8;
        header("Location: ../view/login.php");
        exit();
    }
    if ($var === 2) {
        $_SESSION['error'] = 9;
        header("Location: ../view/login.php");
        exit();
    }
    if ($var === 3) {
        $_SESSION['error'] = 10;
        header("Location: ../view/login.php");
    } else {
        $_SESSION['success'] = 4;
        header("Location: ../view/");
    }
}


// MDP OUBLIE

if (isset($_POST['forgot']) && $_POST['forgot'] === 'ok' && isset($_POST['login'])) {
    if (htmlspecialchars($_POST['login']) !== $_POST['login']) {
        $_SESSION['error'] = 5;
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
        $_SESSION['error'] = 8;
        header('Location: ../view/reset.php');
        exit();
    } else {
        $new_user->passMail($newpass);
        unset($_SESSION['error']);
        $_SESSION['error'] = 3;
        header('Location: ../view/login.php');
    }
}