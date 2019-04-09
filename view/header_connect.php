<?php
require_once "../controllers/ProfilsController.php";
if (!isset($_SESSION)) {
    session_start();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Matcha Dating APP</title>
    <link rel="icon" type="image/png" href="assets/images/favico.png"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/materialize.css">
    <script src="assets/js/materialize.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>

<nav class="fade-in one">
    <div class="nav-wrapper">
        <a href="../" class="brand-logo center logo_home"><i class="fas fa-heart"></i>Matcha</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="logout.php"><i class="material-icons">power_settings_new</i></a></li>
        </ul>
        <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
    </div>
</nav>
<ul id="slide-out" class="sidenav fixed">
    <li>
        <div class="user-view background_sidenav">
            <a href="#user"><img class="circle image_profil_sidenav" src="assets/images/fakeuser.jpg"></a>
            <?php
            $data = recup_user();
            $name = $data['nom'];
            $email = $data['email'];
            echo "
            <a href=\"#name\"><span class=\"white-text name\">$name</span></a>
            <a href=\"#email\"><span class=\"white-text email\">$email</span></a>
            ";
            ?>


        </div>
    </li>
    <li><a class="subheader">Menu Principal</a></li>
    <li><a href="#!"><i class="material-icons">flash_on</i>Matcha now !</a></li>
    <li><a href="#!"><i class="material-icons">whatshot</i>Mes likes</a></li>
    <li><a href="#!"><i class="material-icons">message</i>Messages</a></li>
    <li><a href="history.php"><i class="material-icons">history</i>Historique des visites</a></li>
    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">Paramètres Généraux</a></li>
    <li><a href="account.php"><i class="material-icons">settings</i>Mon profil</a></li>
    <li><a href="logout.php"><i class="material-icons">power_settings_new</i>Se déconnecter</a></li>
    <li><a href="delete.php"><i class="material-icons">delete</i>Supprimer mon compte</a></li>
    <?php

    if (isset($_SESSION['loggued_on_user']))
        if ($_SESSION['loggued_on_user'] === 'root'){
            echo "
            <li><a style='color: #f50057' href=\"random.php\"><i style='color: #f50057' class=\"material-icons\">assignment_ind</i>Générer les FakesUsers</a></li>
            ";
        }
    ?>

</ul>

<!--NOTIFICATIONS-->

<?php
if (isset($_SESSION['success'])) {
    switch ($_SESSION['success']) {
        case 1:
            $icon = 'fas fa-check';
            $message = 'Mise à jour effectuée.';
            break;
        case 2:
            $icon = 'fas fa-envelope';
            $message = 'Un email de confirmation vous à été envoyé !';
            break;
        case 3:
            $icon = 'fas fa-key';
            $message = 'Un nouveau mot de passe vous à été envoyé !';
            break;
        case 4:
            $icon = 'fas fa-check';
            $message = 'Vous êtes connecté !';
            break;
        case 6:
            $icon = 'fas fa-check';
            $message = 'Vos informations ont bien été mises à jour !';
            break;
    }
    echo "
    <div class=\"quotes alert_notif\"><a class=\"success\"><i class=\"$icon icon_spacing\"></i>$message</a></div>
    ";
    unset($_SESSION['success']);
} else if (isset($_SESSION['error'])) {
    switch ($_SESSION['error']) {
        case 1:
            $icon = 'fas fa-exclamation-triangle';
            $message = 'Nom d\'utilisateur trop long.';
            break;
        case 2:
            $icon = 'fas fa-exclamation-triangle';
            $message = 'Les mots de passe ne sont pas identiques.';
            break;
        case 3:
            $icon = 'fas fa-exclamation-triangle';
            $message = 'Votre mot de passe doit contenir au moins 1 caractère spécial.';
            break;
        case 4:
            $icon = 'fas fa-exclamation-triangle';
            $message = 'Votre mot de passe est trop court (6 caractères minimum).';
            break;
        case 5:
            $icon = 'fas fa-bomb';
            $message = 'Script détecté. Petit malin...';
            break;
        case 6:
            $icon = 'fas fa-exclamation-triangle';
            $message = 'Ce nom d\'utilisateur existe déjà.';
            break;
        case 7:
            $icon = 'fas fa-exclamation-triangle';
            $message = 'Cette adresse email existe déjà.';
            break;
        case 8:
            $icon = 'fas fa-times';
            $message = 'Ce compte n\'existe pas.';
            break;
        case 9:
            $icon = 'fas fa-exclamation-triangle';
            $message = 'Vous devez activer votre compte.';
            break;
    }
    echo "
    <div class=\"quotes alert_notif\"><a class=\"error\"><i class=\"$icon icon_spacing\"></i>$message</a></div>
    ";
    unset($_SESSION['error']);
}
?>

<script>
    (function () {

        var quotes = $(".quotes");
        var quoteIndex = -1;

        function showNextQuote() {
            ++quoteIndex;
            quotes.eq(quoteIndex % quotes.length)
                .fadeIn(1000)
                .delay(2000)
                .fadeOut(1000);
        }

        showNextQuote();

    })();
    $(document).ready(function () {
        $('.sidenav').sidenav();
    });
</script>
</body>
</html>