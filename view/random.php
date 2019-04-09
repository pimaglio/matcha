<?php
require '../vendor/autoload.php';
require '../controllers/ProfilsController.php';
use MenaraSolutions\Geographer\Country;


$france = Country::build('FR');;
$faker = Faker\Factory::create('fr_FR');
$login = $_SESSION['loggued_on_user'];
for ($i = 0; $i < 25; $i++) {
    $arr['nom'] = $faker->name;
    $arr['login'] = $faker->userName;
    $arr['location'] = $faker->postcode;
    echo $arr['location'] . '</br>';
    $arr['email'] = $faker->email;
    $arr['password'] = hash('sha256', 'Fabien69@');
    $arr['bio'] =  $faker->realText($maxNbChars = 255, $indexSize = 2);
    $arr['age'] =  $age = rand(18, 116);
    $arr['orientation'] = $ori = rand(0, 6);
    $arr['sexe'] = $sexe = rand(0,5);
    $int = rand(0, 2047);
    $arr['picture'] =  $faker->imageUrl($width = 480, $height = 640, 'cats');
    $arr['interest'] = $base = base_convert($int, 10, 2);
    $arr['popularite'] = rand(0, 10000);
    $_SESSION['loggued_on_user'] = $arr['login'];
//    manage_fake_account($arr);
    unset($_SESSION['loggued_on_user']);
}
$_SESSION['loggued_on_user'] = $login;
//header("Location: ../index.php");

