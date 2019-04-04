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
    <link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/materialize.css">
    <script src="assets/js/materialize.js"></script>

<!--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">-->
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="../" class="brand-logo center"><i class="material-icons">cloud</i>MATCHA</a>
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
            <div class="user-view">
                <div class="background">
                    <img src="assets/images/clouds.png">
                </div>
                <a href="#user"><img class="circle" src="assets/images/profil.svg"></a>
                <a href="#name"><span class="white-text name">John Doe</span></a>
                <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
            </div>
        </li>
        <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
        <li><a href="#!">Second Link</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="subheader">Subheader</a></li>
        <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
    </ul>
</nav>

<script>
    $(document).ready(function () {
        $('.sidenav').sidenav();
    });
</script>
</body>
</html>