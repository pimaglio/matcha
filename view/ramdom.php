<?php
require '../vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');

for ($i = 0; $i < 10; $i++)
{
    $arr = [];
    echo '<h4>'.$faker->name.'</h4>';
    echo $faker->word.'<br>';
    echo $faker->city.'<br>';
    echo $faker->email .'<br>';
    echo 'Fabien69@' . '</br>';
    echo 'age = ' . $faker- . '</br>';
}
