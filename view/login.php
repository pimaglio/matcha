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
    }
    else {
        $ERROR = $_SESSION['alert'];
        echo "<button class='msg-error'><i class=\"fas fa-exclamation-circle icon\"></i>$ERROR</button>";
        echo "<div class='bg-over'></div>";
        header("Refresh:3");
        unset($_SESSION['alert']);
    }
}
?>
<div id="background">
</div>
<div class="container-form">
    <div class="form_pic"></div>
    <h2 class="title-form" >Se connecter</h2>
    <form class="form_index" id="login-form" method="POST" action="../controllers/UsersController.php">
        <p class="title-form2">Login</p>
        <input type="text" name="login" id="login" placeholder="Login"
               required><br/>
        <p class="title-form2">Password</p>
        <input type="password" name="passwd" id="passwd" placeholder="Password" required><br/>
        <input type="submit" name="submit" value="Login" id="submit" class="btn3"/>
        <br/>
    </form>
    <p class="connect">Mot de passe oublié ? <a class="link" href="reset.php">Réinitialiser le mot de passe</a></p>
</div>
</body>