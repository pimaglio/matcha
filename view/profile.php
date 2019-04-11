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
    if (empty($_GET['id'])){
        $_SESSION['error'] = 11;
        header('Location: .');
    }
    if ($db_con->select_id($_GET['id']) == 0){
        $_SESSION['error'] = 11;
        header('Location: .');
    }
    else {
        $db = new history(array(
            'id_usr' => $_SESSION['id'],
            'id_usr_h' => $_GET['id']
        ));
        if ($_SESSION['id'] != $_GET['id']){
            $db->add_history();
            add_popularite($_GET['id'], 5);
        }

    }
}

?>

<body>
<div class="container_profil">
    <?php
    if (is_like_user($_SESSION['id'], $_GET['id']) == 1){
        if (is_match($_SESSION['id'], $_GET['id']) == 1)
            $var = '<h1 style="color: #f50057 !important;" class=\'helikeu fade-in five\'>You Matcha !</h1>';
        else
            $var = '<h1 class=\'helikeu fade-in seven\'>This profile like u</h1>';
    }
    else
        $var = '';
    echo $var;
    ?>

    <div style="position: relative" class="user_profil">
        <?php

        $id_usr = $_SESSION['id'];
        $id_usr_l = $_GET['id'];
        $like = is_like($id_usr, $id_usr_l);
        $match = is_match($id_usr, $id_usr_l);
        if ($match == 1){
            $message = "
        <div class='msg-btn'>
            <a href='message.php?id=$id_usr_l'><button class='waves-effect waves-light btn blue msg-btn' name='like' value='del'><i class=\"material-icons left\">chat_bubble</i>Message</button></a>
        </div>
        ";
        }
        else
            $message = '';
        $signaler = '<div class="signal"><a style=\'font-weight: 200;color: black;\' href="history.php"><i class="material-icons left">feedback</i>Signaler cet utilisateur</a></div>';
        $bloquer = '<div class="blocker"><a style=\'font-weight: 200;color: black;\' href="history.php"><i class="material-icons left">block</i>Bloquer cet utilisateur</a></div>';


        if ($like == 1) {
            $like_btn = "
        <form class='like-btn' method='post' action='../controllers/ProfilsController.php'>
        <input type='hidden' name='id_usr' value='$id_usr'>
        <input type='hidden' name='id_usr_l' value='$id_usr_l'>
        <input type='hidden' name='id' value='$id_usr_l'>
        <button class='waves-effect waves-light btn' name='like' value='del'><i class=\"fas fa-heart-broken left\"></i>DISLIKE</button>
        </form>";
        }
        else {
            $like_btn = "
        <form class='like-btn' method='post' action='../controllers/ProfilsController.php'>
        <input type='hidden' name='id_usr' value='$id_usr'>
        <input type='hidden' name='id_usr_l' value='$id_usr_l'>
        <input type='hidden' name='id' value='$id_usr_l'>
        <button class='waves-effect waves-light btn' name='like' value='add'><i class=\"material-icons left\">favorite</i>LIKE</button>
        </form>";
        }
        if ($_GET['id'] == $_SESSION['id']){
            $like_btn = '';
            $message = '';
            $signaler = '';
            $bloquer = '';
        }

        $user = recup_user_id($_GET['id']);
        $data = recup_data_id($_GET['id']);
        $inter = recup_inter_id($_GET['id']);
        if ($user['statut'] == 1){
            $icon_statut = 'connected';
            $statut = 'Connecté';
        }
        else{
            $icon_statut = 'deconnected';
            $statut = $user['statut'];
        }
        $sex = '';
        $orientation = '';
        switch ($data['sex']) {
            case 0:
                $sex = 'Non binaire';
                break;
            case 1:
                $sex = 'Femme';
                break;
            case 2:
                $sex = 'Homme';
                break;
            case 3:
                $sex = 'Transsexuelle';
                break;
            case 4:
                $sex = 'Transsexuel';
                break;
            case 5:
                $sex = 'Intersexuel';
                break;
        }
        switch ($data['orientation']) {
            case 0:
                $orientation = 'Bisexuel';
                break;
            case 1:
                $orientation = 'Hétérosexuel';
                break;
            case 2:
                $orientation = 'Homosexuel';
                break;
            case 3:
                $orientation = 'Altersexuel';
                break;
            case 4:
                $orientation = 'Pansexuel';
                break;
            case 5:
                $orientation = 'Asexuel';
                break;
            case 6:
                $orientation = 'Sapiosexuel';
                break;
        }
        $sport = $inter['sport'] ? '<div class="col s3 s3"><div class="tag"><p class=""><i class="fas fa-running icon_spacing2"></i>Sport</p></div></div>' : '';
        $voyage = $inter['voyage'] ? '<div class="col s3 rp"><div class="tag"><p class=""><i class="fas fa-plane icon_spacing2"></i>Voyage</p></div></div>' : '';
        $vegan = $inter['vegan'] ? '<div class="col s3 rp"><div class="tag"><p class=""><i class="fas fa-apple-alt icon_spacing2"></i>Vegan</p></div></div>' : '';
        $geek = $inter['geek'] ? '<div class="col s3 rp"><div class="tag"><p class=""><i class="fas fa-gamepad icon_spacing2"></i>Geek</p></div></div>' : '';
        $soiree = $inter['soiree'] ? '<div class="col s3 rp"><div class="tag"><p class=""><i class="fas fa-glass-cheers icon_spacing2"></i>Soirée</p></div></div>' : '';
        $tattoo = $inter['tattoo'] ? '<div class="col s3 rp"><div class="tag"><p class=""><i class="fas fa-dragon icon_spacing2"></i>Tattoo</p></div></div>' : '';
        $musique = $inter['musique'] ? '<div class="col s3 rp"><div class="tag"><p class=""><i class="fas fa-music icon_spacing2"></i>Musique</p></div></div>' : '';
        $lecture = $inter['lecture'] ? '<div class="col s3 rp"><div class="tag"><p class=""><i class="fas fa-book icon_spacing2"></i>Lecture</p></div></div>' : '';
        $theatre = $inter['theatre'] ? '<div class="col s3 rp"><div class="tag"><p class=""><i class="fas fa-theater-masks icon_spacing2"></i>Théâtre</p></div></div>' : '';
        $religion = $inter['religion'] ? '<div class="col s3 rp"><div class="tag"><p class=""><i class="fas fa-peace icon_spacing2"></i>Religion</p></div></div>' : '';

        echo "
        
        <div class=\"user_profil_image\">
            <img class=\"materialboxed circle\" width=\"180\" height=\"180\" src=\"assets/images/fakeuser.jpg\">
        </div>
        $message
        $like_btn
        <div class=\"row center score_profil\">
            <div class=\"col s12\">
                <p><i class=\"fas fa-circle $icon_statut\"></i> $statut</p>
            </div>
        </div>
        <div class=\"row center pdrl\">
            <div class=\"col s12\">
                <b class=\"info_sub_profil\">" . $user['nom'] . ", </b><span>" . $data['age'] . " ans</span>
                <p class=\"fw100\">" . $data['location'] . ", France</p>
            </div>
            <div style=\"margin-top: 20px\" class=\"col s12\">
                <b class=\"info_sub_profil\"><i class=\"fas fa-star icon_spacing\"></i>" . $data['popularite'] . "</b>
                <p>Popularité</p>
            </div>
        </div>
        <div class=\"row pdtb pdrl center\">
            <div class=\"col s6\">
                <b class=\"info_sub_profil fw100\"><i class=\"fas fa-venus-mars icon_spacing\"></i>$sex</b>
            </div>
            <div class=\"col s6\">
                <b class=\"info_sub_profil fw100\"><i class=\"fas fa-search icon_spacing\"></i>$orientation</b>
            </div>
        </div>

        <div style=\"margin-bottom: 50px\" class=\"row center pdrl\"> $sport $voyage $vegan $geek $soiree $tattoo $musique $lecture $theatre $religion
            <div style=\"margin-top: 30px\" class=\"col s12\">
                <hr class=\"style14\">
            </div>
            <div class=\"col s12\">
                <blockquote class=\"ludwig\">" . $data['bio'] . "</blockquote>
            </div>
        </div>
        $signaler
        $bloquer
        ";
        ?>
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