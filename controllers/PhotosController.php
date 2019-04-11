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
    // METTRE LA PHOTO DANS LA DB  (COLLAGE)//
    $pic = 'pp';
    $infos = new infos();
    $infos->add_picture($pic, $collage);
    unset($_POST['hidden_data']);
    echo "ok";
}

if (isset($_POST['hidden_data1'])) {
    $upload_dir = "../view/assets/upload/";
    $img = $_POST['hidden_data1'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    // METTRE LA PHOTO DANS LA DB  (COLLAGE)//
    $pic = 'p1';
    $infos = new infos();
    $infos->add_picture($pic, $collage);
    unset($_POST['hidden_data']);
    echo "ok";
}

if (isset($_POST['hidden_data2'])) {
    $upload_dir = "../view/assets/upload/";
    $img = $_POST['hidden_data2'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    // METTRE LA PHOTO DANS LA DB  (COLLAGE)//
    $pic = 'p2';
    $infos = new infos();
    $infos->add_picture($pic, $collage);
    unset($_POST['hidden_data']);
    echo "ok";
}

if (isset($_POST['hidden_data3'])) {
    $upload_dir = "../view/assets/upload/";
    $img = $_POST['hidden_data3'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    // METTRE LA PHOTO DANS LA DB  (COLLAGE)//
    $pic = 'p3';
    $infos = new infos();
    $infos->add_picture($pic, $collage);
    unset($_POST['hidden_data']);
    echo "ok";
}

if (isset($_POST['hidden_data4'])) {
    $upload_dir = "../view/assets/upload/";
    $img = $_POST['hidden_data4'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    // METTRE LA PHOTO DANS LA DB  (COLLAGE)//
    $pic = 'p4';
    $infos = new infos();
    $infos->add_picture($pic, $collage);
    unset($_POST['hidden_data']);
    echo "ok";
}

