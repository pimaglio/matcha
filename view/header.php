<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="pimaglio" content="Pierre Magliozzi">
    <meta name="description" content="Camagru">
    <title>Camagru</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/images/favico.png"/>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
            <a href="../index.php"
               class="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-pink-dark mr-4">
                <i class="fas fa-camera"></i> STUDIO
            </a>
            <a href="gallery.php"
               class="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-pink-dark mr-4">
                <i class="fas fa-images"></i> Galerie
            </a>
        </div>
        <?php
        if (!isset($_SESSION['loggued_on_user'])) {
            echo '<div>
            <a href="login.php" class="btn-header inline-block text-sm px-4 py-2 leading-none border rounded text-pink-dark border-pink-dark hover:border-text-pink-dark hover:text-white hover:bg-pink-dark mt-4 lg:mt-0 icon"><i class="fas fa-lock icon"></i>CONNEXION</a>
        </div>
        <div>
            <a href="register.php" class="btn-header inline-block text-sm px-4 py-2 leading-none border rounded text-blue-dark border-blue-dark hover:border-text-blue-dark hover:text-white hover:bg-blue-dark mt-4 lg:mt-0"><i class="fas fa-lock icon"></i>S\'INSCRIRE</a>
        </div>';
        } else
            echo '<div>
            <a href="account.php" class="btn-header inline-block text-sm px-4 py-2 leading-none border rounded text-pink-dark border-pink-dark hover:border-text-pink-dark hover:text-white hover:bg-pink-dark mt-4 lg:mt-0 icon"><i class="fas fa-user icon"></i>MON COMPTE</a>
        </div>
        <div>
            <a href="logout.php" class="btn-header inline-block text-sm px-4 py-2 leading-none border rounded text-blue-dark border-blue-dark hover:border-text-blue-dark hover:text-white hover:bg-blue-dark mt-4 lg:mt-0"><i class="fas fa-power-off icon"></i>DÉCONNEXION</a>
        </div>';
        ?>
    </div>
</nav>

<footer>
    <div class="copyright">
        <p class="text-footer">Made with <i class="fas fa-heart text-pink-dark"></i> by<a target="_blank" href="https://profile.intra.42.fr/users/pimaglio"> Pimaglio</a>  <span style="float: right">© 2019</span></p>
    </div>
</footer>

</body>
</html>