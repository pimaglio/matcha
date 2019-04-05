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
$errmdp = 0;
if (isset($_SESSION['error']) && $_SESSION['error'] == 2) {
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Ce nom d'utilisateur existe déjà !</button>";
    unset($_SESSION['error']);
}


if (isset($_SESSION['error']) && $_SESSION['error'] == 6) {
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Cette adresse email existe déjà !</button>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 8) {
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Ce nom d'utilisateur est trop long ! (25 caractères maximum)</button>";
    unset($_SESSION['alert']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 4) {
    $errmdp = 1;
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Mot de pass trop court (6 caractères minimum)</button>";
    unset($_SESSION['alert']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 5) {
    $errmdp = 1;
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Vous devez utiliser 1 caractère spécial (#!$-/=?* .. )</button>";
    unset($_SESSION['alert']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 7) {
    $errmdp = 1;
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Les mots de passes ne correspondent pas</button>";
    unset($_SESSION['alert']);
}

?>
<div id="background">
</div>

<div class="form_create_profil fade-in two">
    <div class="row">
        <div class="col s6">
            <div class="form_pic2"></div>
        </div>
        <div class="col s6">
            <h2 class="title-form">Inscription <br><span class="title-form-alt">Sign in</span></h2>
        </div>
    </div>
    <form id="register-form" method="POST" action="../controllers/ProfilsController.php">
        <div class="row">
            <div class="input-field col s12 fade-in three">
                <i class="material-icons prefix">account_circle</i>
                <input id="nom" type="text" class="validate" pattern="[A-Za-z\s -]+" name="nom" maxlength="50" required>
                <span class="helper-text" data-error="Format invalide: (A-z) et (-)" data-success="Format valide"></span>
                <label for="nom">Nom et Prénom</label>
            </div>
            <div class="input-field col s12 fade-in four">
                <i class="material-icons prefix">account_circle</i>
                <input id="login" type="text" class="validate" pattern="[A-Za-z-0-9\s -]+" name="login" maxlength="25" required>
                <span class="helper-text" data-error="Format invalide: (A-z), (0-9), (-)" data-success="Format valide"></span>
                <label for="login">Nom d'utilisateur</label>
            </div>
            <div class="input-field col s12 fade-in five">
                <i class="material-icons prefix">email</i>
                <input id="email" type="text" class="validate" name="email" required>
                <label for="email">Adresse email</label>
            </div>
            <div class="input-field col s12 fade-in six">
                <i class="material-icons prefix">vpn_key</i>
                <input id="password" type="password" class="validate" pattern="(?=.*[!@#$%^&*(),.?:{}|<>]).{6,}" name="password" maxlength="25" required>
                <span class="helper-text" data-error="Format invalide: Doit contenir 6 caractères minimum dont 1 caractère special (!@#$%^&*(),.?:{}|<>)" data-success="Format valide"></span>
                <label for="password">Mot de passe</label>
            </div>
            <div class="input-field col s12 fade-in seven">
                <i class="material-icons prefix">vpn_key</i>
                <input id="password2" type="password" class="validate" pattern="(?=.*[!@#$%^&*(),.?:{}|<>]).{6,}" name="password2" maxlength="25" required>
                <span class="helper-text" data-error="Les mots de passe ne correspondent pas" data-success="Format valide"></span>

                <label for="password2">Mot de passe (confirmation)</label>
            </div>
        </div>
        <input type="hidden" name="register" value="ok">
        <div style="text-align: center">
            <button class="btn-large waves-effect waves-light pink accent-3 fade-in eight" type="submit" name="submit"
                    value="Créer mon profil">S'inscrire
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
    <div style="text-align: center; margin-top: 50px">
        <p class="connect fade-in seven">Tu es déjà inscrit ? <a class="link" href="login.php">Connecte-toi</a></p>
    </div>
</div>

<script src="assets/js/materialize.js"></script>
<script>
    $(document).ready(function () {
        $('select').formSelect();
    });

    var password = document.getElementById("password")
        , confirm_password = document.getElementById("password2");

    function validatePassword(){
        if(password.value !== confirm_password.value) {
            confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
</body>