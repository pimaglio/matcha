<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 11:59
 */

if (isset($_SESSION['loggued_on_user']))
    header("Location: home.php");
session_start();
include('header_connect.php');
?>

<body>
<?php

?>
<div id="background">
</div>

<main class="my_profil row">

    <div class="col s6">
        <div class="my_pic"></div>
        <h2 class="title-form-alt">Mes <br><span class="title-form">Photos</span></h2>
        <div class="carousel">
            <a class="carousel-item" href="https://lorempixel.com/250/250/nature/1" target="_blank">
                <img class="image_slider" src="https://lorempixel.com/250/250/nature/1">
            </a>
            <a class="carousel-item" href="#two!">
                <img class="image_slider" src="https://lorempixel.com/250/250/nature/2">
            </a>
            <a class="carousel-item" href="#three!">
                <img class="image_slider" src="https://lorempixel.com/250/250/nature/3">
            </a>
            <a class="carousel-item" href="#four!">
                <img class="image_slider" src="https://lorempixel.com/250/250/nature/4">
            </a>
            <a class="carousel-item" href="#five!">
                <img class="image_slider" src="https://lorempixel.com/250/250/nature/5">
            </a>
        </div>
    </div>
    <div class="col s6 panel_info">
        <div class="icon_profil"></div>
        <h2 class="title-form-alt">Mon <br><span class="title-form">Profil</span></h2>
    </div>
    <div class="row">
        <h6 class="title_profil_info">Informations Générales</h6>

    </div>
</main>

<script src="assets/js/materialize.js"></script>
<script>
    $(document).ready(function () {
        $('.carousel').carousel();
    });
</script>

</body>