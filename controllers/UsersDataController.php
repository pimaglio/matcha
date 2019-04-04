<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-13
 * Time: 13:40
 */

if (!isset($_SESSION)) {
    session_start();
}

include("../models/UsersDataModel.php");

if (isset($_POST['hidden_data'])) {

    $upload_dir = "../upload/";
    $img = $_POST['hidden_data'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    $user = New user(array(
        "login" => $_SESSION['loggued_on_user'],
        "picture" => $collage,
        "likes" => 0
    ));
    $user->addCollage();
    unset($_POST['hidden_data']);
}

// SUPPR IMG HOME

if (isset($_POST['pic']) && $_POST['pic']) {
    $fetch = new user(array(
        "picture" => $_POST['pic'],
        "login" => $_SESSION['loggued_on_user']
    ));

    $val = $fetch->deletePicture();
    if ($val !== 3){
        if (file_exists("../upload/" . $_POST['pic'] . ".png"))
            unlink("../upload/" . $_POST['pic'] . ".png");
    }
    header('Location: ../view/' . $_POST['url']);
}

// SUPPR COM

if (isset($_POST['com']) && $_POST['com']) {
    $fetch = new user(array(
        "picture" => $_POST['pic-com'],
        "comments" => $_POST['com'],
        "author" => $_SESSION['loggued_on_user'],
    ));
    $val = $fetch->deleteCom();
    header('Location: ../view/photo.php?id=' . $_POST['pic-com']);
}

// AJOUT COMMENTAIRE

if (isset($_POST['comment']) && $_POST['comment']) {
    $test = $_POST['id'];
    $user = New user(array(
        "picture" => $_POST['id'],
        "comments" => htmlspecialchars($_POST['comment']),
        "author" => $_SESSION['loggued_on_user']
    ));
    $user->addCom();
    $user->comNotif();
    header('Location: ../view/photo.php?id=' . $_POST['id']);
}

//  ADD LIKE

if (isset($_POST['like']) && $_POST['like'] == 'ok') {

    $user = New user(array(
        "picture" => $_POST['id'],
        "likes" => "1",
        "liker" => $_SESSION['loggued_on_user'],
    ));
    $user->addLike();
    header('Location: ../view/' . $_POST['url']);
}

function getPicture()
{
    unset($val);
    $fetch = new user(array(
        "login" => $_SESSION['loggued_on_user']
    ));
    $val = $fetch->getCollageUser();
    if ($val){
        $val = array_reverse($val, true);
        return $val;
    }
    else
        return 0;
}

function getNbLikes($key)
{
    unset($val);
    $fetch = new user(array(
        "picture" => $key,
    ));
    $val = $fetch->getLikes();
    return $val;
}

function getPictureGal($page)
{
    unset($val);
    $fetch = new user(array());
    $val = $fetch->getCollage($page);
    if ($val){
        return $val;
    }
    else
        return 0;

}

function getComment($id2)
{
    $fetch = new user(array());
    $val = $fetch->getcomm($id2);
    if ($val){
        $val = array_reverse($val, true);
        return $val;
    }
    else
        return 0;

}


function isNotif($login)
{
    $fetch = new user(array(
        "login" => $login
    ));
    $val = $fetch->getNotif();
    if ($val){
        return $val;
    }
    else
        return 0;

}

function isPicture($picture) {
    $fetch = new user(array(
        "picture" => $picture
    ));
    $val = $fetch->getPic();
    if ($val){
        return $val;
    }
    else
        return 0;

}

?>


