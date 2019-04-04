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

if (isset($_SESSION['error']) && $_SESSION['error'] == 2) {
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Ce nom d'utilisateur existe déjà !</button>";
    unset($_SESSION['error']);
}

?>
<div id="background">
</div>
<div class="form_create_profil">
    <div class="row">
        <div class="col s6">
            <div class="form_pic2"></div>
        </div>
        <div class="col s6">
            <h2 class="title-form">Création <br><span class="title-form-alt">du profil</span></h2>
        </div>
    </div>
    <form id="register-form" method="POST" action="../controllers/ProfilsController.php">
        <p class="title-form2">Âge (18 à 116 ans)</p>
        <input type="number" name="age" id="age" value="18" min="18" max="116" required><br/>
        <p class="title-form2">Genre</p>
        <div class="input-field col s12">
            <select name="sexe">
                <option class="red" value="0" selected>Non binaire</option>
                <option value="1">Femme</option>
                <option value="2">Homme</option>
                <option value="3">Transsexuelle</option>
                <option value="4">Transsexuel</option>
                <option value="5">Intersexuel</option>
            </select>
        </div>
        <p class="title-form2">Bio (max 255 caractères)</p>
        <textarea id="textarea1" class="materialize-textarea" name='bio' maxlength="255" required></textarea>
        <p class="title-form2">Orientation Sexuelle</p>
        <select id="orientation" name="orientation">
            <option value="0" selected>Bisexuelle</option>
            <option value="1">Hétérosexuelle</option>
            <option value="2">Homosexuelle</option>
            <option value="3">Altersexuelle</option>
            <option value="4">Pansexuelle</option>
            <option value="5">Asexuelle</option>
            <option value="6">Sapiosexuelle</option>
        </select>
        <div class="row">
            <p class="col s4">
                <label>
                    <input type="checkbox" name="sport" value="1"/>
                    <span>Sport</span>
                </label>
            </p>
            <p class="col s4">
                <label>
                    <input type="checkbox" name="voyage" value="1"/>
                    <span>Voyage</span>
                </label>
            </p>
            <p class="col s4">
                <label>
                    <input type="checkbox" name="vegan" value="1"/>
                    <span>Vegan</span>
                </label>
            </p>
            <p class="col s4">
                <label>
                    <input type="checkbox" name="geek" value="1"/>
                    <span>Geek</span>
                </label>
            </p>
            <p class="col s4">
                <label>
                    <input type="checkbox" name="soiree" value="1"/>
                    <span>Soiree</span>
                </label>
            </p>
            <p class="col s4">
                <label>
                    <input type="checkbox" name="tattoo" value="1"/>
                    <span>Tattoo</span>
                </label>
            </p>
            <p class="col s4">
                <label>
                    <input type="checkbox" name="musique" value="1"/>
                    <span>Musique</span>
                </label>
            </p>
            <p class="col s4">
                <label>
                    <input type="checkbox" name="lecture" value="1"/>
                    <span>Lecture</span>
                </label>
            </p>
            <p class="col s4">
                <label>
                    <input type="checkbox" name="association" value="1"/>
                    <span>Association</span>
                </label>
            </p>
            <p class="col s4">
                <label>
                    <input type="checkbox" name="theatre" value="1"/>
                    <span>Théâtre</span>
                </label>
            </p>
            <p class="col s4">
                <label>
                    <input type="checkbox" name="religion" value="1"/>
                    <span>Religion</span>
                </label>
            </p>
        </div>
        <input type="hidden" name="createprofile" value="ok">
        <div style="text-align: center">
            <button class="btn-large waves-effect waves-light pink accent-3" type="submit" name="submit"
                    value="Créer mon profil">Créer mon profil
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