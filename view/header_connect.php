<?php
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
<nav>
    <div class="nav-wrapper">
        <a href="../" class="brand-logo center logo_home"><i class="fas fa-heart"></i>Matcha</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="sass.html"><i class="material-icons">search</i></a></li>
            <li><a href="badges.html"><i class="material-icons">view_module</i></a></li>
            <li><a href="collapsible.html"><i class="material-icons">refresh</i></a></li>
            <li><a href="mobile.html"><i class="material-icons">more_vert</i></a></li>
        </ul>
        <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large"><i class="material-icons">menu</i></a>
    </div>
    <ul id="slide-out" class="sidenav fixed">
        <li>
            <div class="user-view background_sidenav">
                <a href="#user"><img class="circle" src="assets/images/me.jpg"></a>
                <a href="#name"><span class="white-text name">Eric Reptil</span></a>
                <a href="#email"><span class="white-text email">lereptildu69@marzingue.com</span></a>
            </div>
        </li>
        <li><a class="subheader">Menu Principal</a></li>
        <li><a href="#!"><i class="fas fa-bolt"></i>Matcha Now !</a></li>
        <li><a href="#!"><i class="fas fa-heart"></i>Mes likes</a></li>
        <li><a href="#!"><i class="fas fa-envelope"></i>Messages</a></li>
        <li><a href="#!"><i class="fas fa-history"></i>Historique des visites</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="subheader">Paramètres Généraux</a></li>
        <li><a href="account.php"><i class="fas fa-user-edit"></i>Mon profil</a></li>
        <li><a href="logout.php"><i class="fas fa-power-off"></i>Se déconnecter</a></li>
    </ul>
</nav>

<script>
    $(document).ready(function () {
        $('.sidenav').sidenav();
    });
</script>
</body>
</html>