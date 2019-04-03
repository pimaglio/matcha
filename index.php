<?php

session_start();
if (isset($_SESSION['loggued_on_user']))
    header('Location: view/home.php');
if (isset($_SESSION['alert'])) {
    if ($_SESSION['alert'] == 2) {
        echo "<button class='msg-success'><i class=\"fas fa-envelope icon\"></i>Vous devez activer votre compte via le mail d'activation avant de pouvoir l'utiliser.</button>";
        echo "<div class='bg-over'></div>";
        header("Refresh:3");
        unset($_SESSION['alert']);
    }
    else {
        $alert = $_SESSION['alert'];
        echo "<button class='msg-error'><i class=\"fas fa-envelope icon\"></i>$alert</button>";
        echo "<div class='bg-over'></div>";
        header("Refresh:3");
        unset($_SESSION['alert']);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="pimaglio, ftreand" content="Pierre Magliozzi, Fabien Treand">
    <meta name="description" content="Matcha">
    <title>Matcha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="view/assets/images/favico.png"/>
    <link rel="stylesheet" type="text/css" href="view/assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
<nav class="flex items-center justify-between flex-wrap bg-white p-6">
    <div class="flex items-center flex-no-shrink text-white mr-6">
        <a href="../index.php" target="_self">
            <h1 class="lg-title">cama</h1>
            <h1 class="lg">gru.</h1>
        </a>
    </div>
    <div class="block lg:hidden">
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="link-menu lg:flex-grow">
            <a href="index.php"
               class="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-pink-dark mr-4">
                <i class="fas fa-camera"></i> STUDIO
            </a>
            <a href="view/gallery.php"
               class="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-pink-dark mr-4">
                <i class="fas fa-images"></i> Galerie
            </a>
        </div>
        <?php
        if (!isset($_SESSION['loggued_on_user'])) {
            echo '<div>
            <a href="view/login.php" class="btn-header inline-block text-sm px-4 py-2 leading-none border rounded text-pink-dark border-pink-dark hover:border-text-pink-dark hover:text-white hover:bg-pink-dark mt-4 lg:mt-0 icon"><i class="fas fa-lock icon"></i>CONNEXION</a>
        </div>
        <div>
            <a href="view/register.php" class="btn-header inline-block text-sm px-4 py-2 leading-none border rounded text-blue-dark border-blue-dark hover:border-text-blue-dark hover:text-white hover:bg-blue-dark mt-4 lg:mt-0"><i class="fas fa-lock icon"></i>S\'INSCRIRE</a>
        </div>';
        } else
            echo '<div>
            <a href="view/account.php" class="btn-header inline-block text-sm px-4 py-2 leading-none border rounded text-pink-dark border-pink-dark hover:border-text-pink-dark hover:text-white hover:bg-pink-dark mt-4 lg:mt-0 icon"><i class="fas fa-user icon"></i>MON COMPTE</a>
        </div>
        <div>
            <a href="view/logout.php" class="btn-header inline-block text-sm px-4 py-2 leading-none border rounded text-blue-dark border-blue-dark hover:border-text-blue-dark hover:text-white hover:bg-blue-dark mt-4 lg:mt-0"><i class="fas fa-power-off icon"></i>DÉCONNEXION</a>
        </div>';
        ?>
    </div>
</nav>
<div id="background">
</div>
<div style="padding-top: 8%">

    <div style="width: 80%; margin: auto" class="flex flex-resp2">
        <div style="margin-top: 210px;" class="flex px-4 py-2 m-2">
            <div style="">
            <h1>Camagru Project</h1>
            <p class="my-4">Bienvenue sur la page du projet Camagru.</br>Vous pourrez au travers de ce mini-site, réaliser et partager
                des
                photo-montages.</p>
            <?php
            if (!isset($_SESSION['loggued_on_user'])) {
                echo '<a href="view/login.php" class="btn"><i class="fas fa-user-circle icon"></i>Se Connecter</a><a href="view/register.php" class="btn2"><i class="fas fa-user-plus icon"></i>S\'enregistrer</a>';
            }
            ?>
        </div>
        </div>
        <div class="flex-1 text-center px-4 py-2 m-2">
            <img src="view/assets/images/preview.png">
        </div>
    </div>


</div>

</body>
</html>