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
        echo "<button class='msg-success'><i class=\"fas fa-envelope icon\"></i>Un nouveau mot de passe vient de vous être envoyé par email.</button>";
        unset($_SESSION['alert']);
    }
    else {
        echo "<button class='msg-error'><i class=\"fas fa-exclamation-circle icon\"></i>Ce compte n'existe pas.</button>";
        unset($_SESSION['alert']);
    }
}
?>
<div id="background">
</div>
<div class="container-form">
    <div class="form_pic"></div>
    <h2 class="title-form" >Réinitialiser le mot de passe</h2>
    <form class="form_index" id="login-form" method="POST" action="../controllers/UsersController.php">
        <p class="title-form2">Login</p>
        <input type="text" name="login" id="login" placeholder="Login"
               required><br/>
        <input type="hidden" name="forgot" value="ok"><br/>
        <input type="submit" name="submit" value="Envoyer" id="submit" class="btn3"/>
        <br/>
    </form>
</div>
</body>