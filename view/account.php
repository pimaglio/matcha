<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 17:12
 */

include('header.php');
include('../controllers/UsersDataController.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['loggued_on_user']))
    header('Location: ../index.php');
$_USER = $_SESSION['loggued_on_user'];
if (isset($_SESSION['alert'])) {
    if ($_SESSION['alert'] === 'success') {
        echo "<button class='msg-success'><i class=\"fas fa-envelope icon\"></i>Vous êtes connecté, Bienvenue $_USER</button>";
        echo "<div class='bg-over'></div>";
        header("Refresh:3");
        unset($_SESSION['alert']);
    }
}
if (isset($_SESSION['error']) && $_SESSION['error'] == 2) {
    echo "<button class='msg-error'><i class=\"fas fa-exclamation-circle icon\"></i>Ce nom d'utilisateur existe déjà !</button>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 8) {
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Ce nom d'utilisateur est trop long ! (25 caractères maximum)</button>";
    unset($_SESSION['alert']);
}

if (isset($_SESSION['error']) && $_SESSION['error'] == 6) {
    echo "<button class='msg-error'><i class=\"fas fa-exclamation-circle icon\"></i>Cette adresse email existe déjà !</button>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 4) {
    $errmdp = 1;
    echo "<button class='msg-error'><i class=\"fas fa-exclamation-circle icon\"></i>Mot de pass trop court (6 caractères minimum)</button>";
    unset($_SESSION['alert']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 5) {
    $errmdp = 1;
    echo "<button class='msg-error'><i class=\"fas fa-exclamation-circle icon\"></i>Vous devez utiliser 1 caractère spécial (#!$-/=?* .. )</button>";
    unset($_SESSION['alert']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 11) {
    $errmdp = 1;
    echo "<button class='msg-success'><i class=\"fas fa-exclamation-circle icon\"></i>Mot de passe modifié !</button>";
    echo "<div class='bg-over'></div>";
    header("Refresh:3");
    unset($_SESSION['alert']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 12) {
    $errmdp = 1;
    echo "<button class='msg-success'><i class=\"fas fa-exclamation-circle icon\"></i>Login modifié !</button>";
    echo "<div class='bg-over'></div>";
    header("Refresh:3");
    unset($_SESSION['alert']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 13) {
    $errmdp = 1;
    echo "<button class='msg-success'><i class=\"fas fa-exclamation-circle icon\"></i>Email modifié !</button>";
    echo "<div class='bg-over'></div>";
    header("Refresh:3");
    unset($_SESSION['alert']);
}

?>
<body>

<div id="background">
</div>

<div class="container-admin">
    <div class="tab2">
        <div class="top-admin">
            <div class="profil_pic"></div>
            <?php
            $user = $_SESSION['loggued_on_user'];
            if (strlen($user) > 15)
                echo "<h3 style=\"margin-top: 20px; font-size: 12px\">$user</h3>";
            else
                echo "<h3 style=\"margin-top: 20px;\">$user</h3>";
            ?>
        </div>
        <button class="tablinks" onclick="openCity(event, 'edit_profil')" id=""><i class="fas fa-user-cog icon2"></i>Modifier mon profil
        </button>
        <button class="tablinks" onclick="openCity(event, 'order')" id=""><i class="fas fa-images icon2"></i>Mes Photos
        </button>
    </div>

    <!-- MODIFICATION DU PROFIL-->

    <div id="edit_profil" class="tabcontent">
        <h2 class="title-form">Modifier mon profil</h2>
        <hr class="ligne">
        <div id="box-create-item">
            <form action="../controllers/UsersController.php" method="POST">
                <input type="text" name="login" placeholder="Nouveau pseudo">
                <input type="password" name="password" placeholder=" Nouveau Mot de passe">
                <input type="email" name="email" placeholder="Nouvelle Adresse Email">
                <label for="notif" >Souhaitez-vous recevoir des notifications ?</label>
                <select name="notif" id="select">
                    <option value="">--Choisissez une option--</option>
                    <option value="yes">Oui</option>
                    <option value="no">Non</option>
                </select>
                <button type="submit" id="editprofil" name="submit" value="editprofil" class="btn5"><i class="fas fa-cogs icon2"></i>Modifier mon profil</button>
            </form>
        </div>
    </div>
    <div id="order" class="tabcontent">
        <h2 class="title-form">Mes Photos</h2>
        <div class="flex content-start flex-wrap">
            <?php

            $val = getPicture();
            if ($val) {

                foreach ($val as $key) {
                    $title = $key;
                    echo "<div style='text-align: center; position: relative' class=\"image-gal-account h-auto rounded overflow-hidden shadow-lg bg-white m-8\" style='position: relative'>
            <img class=\"h-64 w-auto\" src=\"../upload/$key.png\" alt=\"Photo de moi\">
            <div class=\"bg-white \" style='padding-bottom: 20px'>
            <h4 style='padding-bottom: 10px; color: #22292f'>Photo <span style='color: #eb5286'>#$title</span></h4>
            <div class='item-top'>
            <form class='btn-dl' action=\"../controllers/UsersDataController.php\" method=\"post\">
            <input type='hidden' name='pic' value='$key'>
            <input type='hidden' name='url' value='account.php'>
                <button class=\"bg-white hover:bg-pink-dark text-indigo-darkest font-light hover:text-white py-2 px-4 hover:border-transparent rounded mx-2 \">
                    <i class=\"fas fa-trash-alt\"></i>
                </button>
                </form>
                <br><br>
                </div>
                <button class=\"bg-indigo-darkest hover:bg-indigo-dark text-white hover:text-white py-2 px-4 border border-indigo-darkest hover:border-transparent rounded mx-2 \" onclick=\"javascript:genericSocialShare('$key')\">
                    <i class=\"fab fa-facebook-f\"></i>
                </button>
                <button onclick=\"window.location.href='photo.php?id=$key'\" class=\"hover:bg-blue-dark  bg-indigo-darkest text-white hover:text-white py-2 px-4 border hover:border-blue-dark border-indigo-darkest rounded mx-2 \">
                    <i class=\"far fa-comments icon\"></i>Comment
                </button>
            </div>
        </div>";
                }
            }
            ?>
        </div>
    </div>
</div>

<script src="assets/js/script.js"></script>

<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("edit_profil").click();
</script>

</body>
</html>
