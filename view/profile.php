<?php
include('header_connect.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['loggued_on_user']))
    header('Location: ../index.php');

if (!isset($_GET['id']))
    header('Location: .');

if (isset($_GET['id'])) {
    $db_con = new account([]);
    $db2 = new infos([]);
    if (empty($_GET['id']))
        header('Location: .');
    if ($db_con->select_id($_GET['id']) == 0)
        header('Location: .');
    else {
        $db = new history(array(
            'id_usr' => $db2->find_id(),
            'id_usr_h' => $_GET['id']
        ));
        $db->add_history();
    }
}


?>

<body>
<?php

$id_usr = $_SESSION['loggued_on_user'];


?>

<div class="container_profil">

    <div class="user_profil">
        <div class="user_profil_image">
            <img class="materialboxed circle" width="180" height="180" src="assets/images/fakeuser.jpg">
        </div>
        <div class="row center score_profil">
            <div class="col s12">
                <p><i class="fas fa-circle connected"></i> Connecté</p>
            </div>
        </div>
        <div class="row center pdrl">
            <div class="col s12">
                <b class="info_sub_profil">Eric Reptile, </b><span>27ans</span>
                <p class="fw100">Marseille, France</p>
            </div>
            <div style="margin-top: 20px" class="col s12">
                <b class="info_sub_profil"><i class="fas fa-star icon_spacing"></i>456</b>
                <p>Popularité</p>
            </div>
        </div>
        <div class="row pdtb pdrl center">
            <div class="col s6">
                <b class="info_sub_profil fw100"><i class="fas fa-venus-mars icon_spacing"></i>Homme</b>
            </div>
            <div class="col s6">
                <b class="info_sub_profil fw100"><i class="fas fa-search icon_spacing"></i>Babtou</b>
            </div>
        </div>

        <div style="margin-bottom: 50px" class="row center pdrl">
            <div class="col s3 s3">
                <div class="tag">
                    <p class=""><i class="fas fa-running icon_spacing2"></i>Sport</p>
                </div>
            </div>
            <div class="col s3 rp">
                <div class="tag">
                    <p class=""><i class="fas fa-plane icon_spacing2"></i>Voyage</p>
                </div>
            </div>
            <div class="col s3 rp">
                <div class="tag">
                    <p class=""><i class="fas fa-apple-alt icon_spacing2"></i>Vegan</p>
                </div>
            </div>
            <div class="col s3 rp">
                <div class="tag">
                    <p class=""><i class="fas fa-gamepad icon_spacing2"></i>Geek</p>
                </div>
            </div>
            <div class="col s3 rp">
                <div class="tag">
                    <p class=""><i class="fas fa-glass-cheers icon_spacing2"></i>Soirée</p>
                </div>
            </div>
            <div class="col s3 rp">
                <div class="tag">
                    <p class=""><i class="fas fa-dragon icon_spacing2"></i>Tattoo</p>
                </div>
            </div>
            <div class="col s3 rp">
                <div class="tag">
                    <p class=""><i class="fas fa-music icon_spacing2"></i>Musique</p>
                </div>
            </div>
            <div class="col s3 rp">
                <div class="tag">
                    <p class=""><i class="fas fa-book icon_spacing2"></i>Lecture</p>
                </div>
            </div>
            <div class="col s3 rp">
                <div class="tag">
                    <p class=""><i class="fas fa-theater-masks icon_spacing2"></i>Théâtre</p>
                </div>
            </div>
            <div class="col s3 rp">
                <div class="tag">
                    <p class=""><i class="fas fa-peace icon_spacing2"></i>Religion</p>
                </div>
            </div>
            <div class="col s3 rp">
                <div class="tag">
                    <p class=""><i class="fas fa-palette icon_spacing2"></i>Peinture</p>
                </div>
            </div>
            <div style="margin-top: 30px" class="col s12">
                <hr class="style14">
            </div>
            <div class="col s12">
                <blockquote class="ludwig">
                    I don't know why we are here, but I'm pretty sure that it is not in order to enjoy ourselves.
                </blockquote>
            </div>
        </div>
    </div>

    <div class="user_profil_gallery">
        <div class="carousel">
            <a class="carousel-item" href="#one!"><img src="https://lorempixel.com/250/250/nature/1"></a>
            <a class="carousel-item" href="#two!"><img src="https://lorempixel.com/250/250/nature/2"></a>
            <a class="carousel-item" href="#three!"><img src="https://lorempixel.com/250/250/nature/3"></a>
            <a class="carousel-item" href="#four!"><img src="https://lorempixel.com/250/250/nature/4"></a>
            <a class="carousel-item" href="#five!"><img src="https://lorempixel.com/250/250/nature/5"></a>
        </div>
    </div>

</div>


<script src="assets/js/materialize.js"></script>
<script>
    $(document).ready(function () {
        $('.carousel').carousel();
    });
    $(document).ready(function () {
        $('.materialboxed').materialbox();
    });
</script>
</body>