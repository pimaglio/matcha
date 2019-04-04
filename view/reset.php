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
include('header_alt.php');
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

<div class="form_create_profil" style="padding-bottom: 50px">
    <div class="row">
        <div class="col s6">
            <div class="form_pic2"></div>
        </div>
        <div class="col s6">
            <h2 class="title-form">Réinitialiser <br><span class="title-form-alt">le mot de passe</span></h2>
        </div>
    </div>
    <form id="register-form" method="POST" action="../controllers/UsersController.php">
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input id="login" type="text" class="validate" name="login" required>
                <label for="login">Nom d'utilisateur</label>
            </div>
        </div>
        <input type="hidden" name="forgot" value="ok"><br/>
        <div style="text-align: center">
            <button class="waves-teal btn-large" type="submit" name="submit"
                    value="Créer mon profil">Recevoir un email
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>

<script src="assets/js/materialize.js"></script>
<script>
    $(document).ready(function () {
        $('select').formSelect();
    });
</script>

</body>