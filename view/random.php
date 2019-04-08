<?php
require '../vendor/autoload.php';
require '../controllers/ProfilsController.php';

$faker = Faker\Factory::create('fr_FR');
for ($i = 0; $i < 10; $i++) {
    $arr['nom'] = $faker->name;
    $arr['login'] = $faker->word;
    $arr['location'] = $faker->city;
    $arr['email'] = $faker->email;
    $arr['password'] = hash('sha256', 'Fabien69@');
    $arr['bio'] =  $faker->realText($maxNbChars = 255, $indexSize = 2);
    $arr['age'] =  $age = rand(18, 116) . '</br>';
    $arr['orientation'] = $ori = rand(0, 6);
    $arr['sexe'] = $sexe = rand(0,5);
    $int = rand(0, 2047) . '</br>';
    $arr['picture'] =  $faker->imageUrl($width = 480, $height = 640) . '</br>';
    $arr['interest'] = $base = base_convert($int, 10, 2) . '</br>';
    var_dump($arr);
    $_SESSION['loggued_on_user'] = $arr['login'];
    manage_fake_account($arr);
    unset ($_SESSION);
}
