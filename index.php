<?php
session_start();

if (isset($_SESSION['loggued_on_user']))
    header("Location: ./view");


include('header.php');

?>

<body>
<?php
if (isset($_SESSION['alert'])) {
    if ($_SESSION['alert'] === 'success') {
        echo "<button class='msg-success'><i class=\"fas fa-envelope icon\"></i>Votre compte est activé ! Vous pouvez vous connecter.</button>";
        echo "<div class='bg-over'></div>";
        header("Refresh:3");
        unset($_SESSION['alert']);
    } else {
        $ERROR = $_SESSION['alert'];
        echo "<button class='msg-error'><i class=\"fas fa-exclamation-circle icon\"></i>$ERROR</button>";
        echo "<div class='bg-over'></div>";
        header("Refresh:3");
        unset($_SESSION['alert']);
    }
}
?>

<div class="home_page row">
    <h1 class="logo_home fade-in one">
        Matcha
    </h1>
    <div class="home_content fade-in two">
        <div class="col s6 home_left_col">
            <a href="view/register.php" class="waves-effect waves-light btn-large"><i
                        class="material-icons left">create</i>Inscription</a>
        </div>
        <div class="col s6 home_right_col fade-in three">
            <a href="view/login.php" class="waves-effect waves-light btn-large blue"><i
                        class="material-icons left">person</i>Connexion</a>
        </div>
    </div>
</div>

<script src="view/assets/js/materialize.js"></script>

</body>