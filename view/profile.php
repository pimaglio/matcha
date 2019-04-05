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

<main class="my_profil row">

    <div class="col s6">
        <div class="my_pic"></div>
        <h2 class="title-form-alt">Mes <br><span class="title-form">Photos</span></h2>
        <div class="container_slider">
            <div class="carousel carousel-slider">
                <a class="carousel-item" href="#one!"><img src="https://lorempixel.com/800/400/food/1"></a>
                <a class="carousel-item" href="#two!"><img src="https://lorempixel.com/800/400/food/2"></a>
                <a class="carousel-item" href="#three!"><img src="https://lorempixel.com/800/400/food/3"></a>
                <a class="carousel-item" href="#four!"><img src="https://lorempixel.com/800/400/food/4"></a>
            </div>
        </div>

    </div>
    <div class="col s6 panel_info">
        <div class="icon_profil"></div>
        <h2 class="title-form-alt">Informations<br><span class="title-form">Générales</span></h2>
    </div>

</main>

<div class="card-profile shadow card">
    <div class="justify-content-center row">
        <div class="order-lg-2 col-lg-3">
            <div class="card-profile-image"><a href="#pablo"><img alt="..." class="rounded-circle"
                                                                  src="/argon-dashboard-react/static/media/team-4-800x800.23007132.jpg"></a>
            </div>
        </div>
    </div>
    <div class="text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4 card-header">
        <div class="d-flex justify-content-between"><a href="#pablo" class="mr-4 btn btn-info btn-sm">Connect</a><a
                    href="#pablo" class="float-right btn btn-default btn-sm">Message</a></div>
    </div>
    <div class="pt-0 pt-md-4 card-body">
        <div class="row">
            <div class="col">
                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div><span class="heading">22</span><span class="description">Friends</span></div>
                    <div><span class="heading">10</span><span class="description">Photos</span></div>
                    <div><span class="heading">89</span><span class="description">Comments</span></div>
                </div>
            </div>
        </div>
        <div class="text-center"><h3>Jessica Jones<span class="font-weight-light">, 27</span></h3>
            <div class="h5 font-weight-300"><i class="ni location_pin mr-2"></i>Bucharest, Romania</div>
            <div class="h5 mt-4"><i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
            </div>
            <div><i class="ni education_hat mr-2"></i>University of Computer Science</div>
            <hr class="my-4">
            <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all
                of his own music.</p><a href="#pablo">Show more</a></div>
    </div>
</div>

<script src="assets/js/materialize.js"></script>
<script>
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
    });
    $(document).ready(function () {
        $('select').formSelect();
    });


    var password = document.getElementById("password")
        , confirm_password = document.getElementById("password2");

    function validatePassword() {
        if (password.value !== confirm_password.value) {
            confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

</body>