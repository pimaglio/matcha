<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-04-11
 * Time: 18:03
 */
if (isset($_POST['hidden_data'])) {
    $upload_dir = "../view/assets/upload/";
    $img = $_POST['hidden_data'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    /*$user = New user(array(
        "login" => $_SESSION['loggued_on_user'],
        "picture" => $collage,
        "likes" => 0
    ));
    $user->addCollage();*/
    unset($_POST['hidden_data']);
    echo "ok";
}

if (isset($_POST['addPostButton']) || isset($_FILES['image'])) {

    $imageName = date('Y-m-d_g:i:s');
    $imageDirectory = '../view/assets/upload/' . date('Y-m-d_g:i:s') . ".png";

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $imageDirectory)) {
        $_SESSION['ErrorMessage'] = 'File is invalid!';
    } else {
        echo $_POST['image'];
    }
}