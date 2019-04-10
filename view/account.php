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
include('header_connect.php');

?>

<body>
<?php

?>

<main class="my_profil row">

    <div class="col s6">
        <div class="my_pic"></div>
        <h2 class="title-form-alt">Mes <br><span class="title-form">Photos</span></h2>
        <div class="container_slider">
            <div class="carousel carousel-slider">
                <a class="carousel-item" href="#one!"><img src="https://lorempixel.com/800/400/food/1"></a>
                <a class="carousel-item" href="#two!"><img src="https://lorempixel.com/800/400/food/2"></a>
                <a class="carousel-item" href="#three!"><img src="https://lorempixel.com/800/400/food/3"></a>
                <a class="carousel-item" href="#four!"><img src="https://lorempixel.com/800/400/food/4"></a>
            </div>
        </div>

        <div class="file-field input-field">
            <div class="btn">
                <span>Choisir</span>
                <input type="file" multiple>
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Uploader une photo">
            </div>
        </div>
    </div>
    <div class="col s6 panel_info">
        <div class="icon_profil"></div>
        <h2 class="title-form-alt">Informations<br><span class="title-form">Générales</span></h2>
    </div>
    <div class="row">
        <?php
        $user = recup_user();
        $user_name = $user['nom'];
        $user_login = $user['login'];
        $user_email = $user['email'];
        echo "
       
        <form id=\"user-form\" method=\"POST\" action=\"../controllers/ProfilsController.php\">
            <div class=\"row\">
                <div class=\"input-field col s3\">
                    <i class=\"material-icons prefix\">account_circle</i>
                    <input id=\"nom\" type=\"text\" value='$user_name' class=\"validate\" pattern=\"[A-Za-z\s -]+\" name=\"nom\" maxlength=\"50\"
                           required>
                    <span class=\"helper-text\" data-error=\"Format invalide: (A-z) et (-)\"
                          data-success=\"Format valide\"></span>
                    <label for=\"nom\">Nom et Prénom</label>
                </div>
                <div class=\"input-field col s3\">
                    <i class=\"material-icons prefix\">account_circle</i>
                    <input id=\"login\" type=\"text\"  value='$user_login' class=\"validate\" pattern=\"[A-Za-z-0-9\s -]+\" name=\"login\"
                           maxlength=\"25\" required>
                    <span class=\"helper-text\" data-error=\"Format invalide: (A-z), (0-9), (-)\"
                          data-success=\"Format valide\"></span>
                    <label for=\"login\">Nom d'utilisateur</label>
                </div>
                <div class=\"input-field col s3\">
                    <i class=\"material-icons prefix\">vpn_key</i>
                    <input id=\"password\" type=\"password\" class=\"validate\" pattern=\"(?=.*[!@#$%^&*(),.?:{}|<>]).{6,}\"
                           name=\"password\" maxlength=\"25\">
                    <span class=\"helper-text\"
                          data-error=\"Format invalide: Doit contenir 6 caractères minimum dont 1 caractère special (!@#$%^&*(),.?:{}|<>)\"
                          data-success=\"Format valide\"></span>
                    <label for=\"password\">Mot de passe</label>
                </div>
                <div class=\"input-field col s3\">
                    <i class=\"material-icons prefix\">vpn_key</i>
                    <input id=\"password2\" type=\"password\" class=\"validate\" pattern=\"(?=.*[!@#$%^&*(),.?:{}|<>]).{6,}\"
                           name=\"password2\" maxlength=\"25\">
                    <span class=\"helper-text\" data-error=\"Les mots de passe ne correspondent pas\"
                          data-success=\"Format valide\"></span>

                    <label for=\"password2\">Mot de passe (confirmation)</label>
                </div>
                <div class=\"input-field col s3\">
                    <i class=\"material-icons prefix\">email</i>
                    <input id=\"email\" type=\"text\" value='$user_email' class=\"validate\" name=\"email\" required>
                    <label for=\"email\">Adresse email</label>
                </div>
                <div class=\"col s12\" style=\"text-align: right\">
                    <button class=\"btn-large waves-effect waves-light pink accent-3\" type=\"submit\" name=\"submit\"
                            value=\"Créer mon profil\">Mettre à jour
                        <i class=\"material-icons right\">send</i>
                    </button>
                </div>
            </div>
            <input type=\"hidden\" name=\"user_modif\" value=\"ok\">
        </form>
        
        ";
        ?>
    </div>
</main>


<main class="my_profil row">

    <div class="col s12 panel_info">
        <div class="icon_profil2"></div>
        <h2 class="title-form-alt">Mes données<br><span class="title-form">personelles</span></h2>
    </div>
    <?php
    $data = recup_data();
    $data_age = $data['age'];
    $data_location = $data['location'];
    $data_bio = $data['bio'];
    $interest = recup_inter();

    echo "
    <form id=\"data-form\" method=\"POST\" action=\"../controllers/ProfilsController.php\">
        <div class=\"col s3\">
            <p class=\"title-form2\">Âge (18 à 116 ans)</p>
            <input type=\"number\" name=\"age\" id=\"age\" value=\"$data_age\" min=\"18\" max=\"116\" required><br/>
        </div>
        <div class=\"col s3\">
            <p class=\"title-form2\">Ville</p>
            <input type=\"text\" name=\"location\" value=' $data_location' id=\"location\" required><br/>
        </div>
        <div class=\"col s3\">
            <p class=\"title-form2\">Genre</p>
            <select name=\"sexe\">
                <option class=\"red\" value=\"0\""; if ($data['sex'] == 0) echo 'selected'; echo ">Non binaire</option>
                <option value=\"1\""; if ($data['sex'] == 1) echo 'selected'; echo ">Femme</option>
                <option value=\"2\""; if ($data['sex'] == 2) echo 'selected'; echo ">Homme</option>
                <option value=\"3\""; if ($data['sex'] == 3) echo 'selected'; echo ">Transsexuelle</option>
                <option value=\"4\""; if ($data['sex'] == 4) echo 'selected'; echo ">Transsexuel</option>
                <option value=\"5\""; if ($data['sex'] == 5) echo 'selected'; echo ">Intersexuel</option>
            </select>
        </div>
        <div class=\"col s3\">
            <p class=\"title-form2\">Orientation Sexuelle</p>
            <select id=\"orientation\" name=\"orientation\">
                <option value=\"0\""; if ($data['orientation'] == 0) echo 'selected'; echo ">Bisexuelle</option>
                <option value=\"1\""; if ($data['orientation'] == 1) echo 'selected'; echo ">Hétérosexuelle</option>
                <option value=\"2\""; if ($data['orientation'] == 2) echo 'selected'; echo ">Homosexuelle</option>
                <option value=\"3\""; if ($data['orientation'] == 3) echo 'selected'; echo ">Altersexuelle</option>
                <option value=\"4\""; if ($data['orientation'] == 4) echo 'selected'; echo ">Pansexuelle</option>
                <option value=\"5\""; if ($data['orientation'] == 5) echo 'selected'; echo ">Asexuelle</option>
                <option value=\"6\""; if ($data['orientation'] == 6) echo 'selected'; echo ">Sapiosexuelle</option>
            </select>
        </div>
        <div class=\"col s12\">
            <p class=\"title-form2\">Bio (max 255 caractères)</p>
            <textarea id=\"textarea1\" class=\"materialize-textarea\" name='bio' maxlength=\"255\" required>$data_bio</textarea>
            <p class=\"title-form2\">Centre(s) d'intérêt(s)</p>
        </div>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"sport\" value=\"101\""; if ($interest['sport'] == 1) echo 'checked'; echo "/>
                <span>Sport</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"voyage\" value=\"101\""; if ($interest['voyage'] == 1) echo 'checked'; echo "/>
                <span>Voyage</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"vegan\" value=\"101\""; if ($interest['vegan'] == 1) echo 'checked'; echo "/>
                <span>Vegan</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"geek\" value=\"101\""; if ($interest['geek'] == 1) echo 'checked'; echo "/>
                <span>Geek</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"soiree\" value=\"101\""; if ($interest['soiree'] == 1) echo 'checked'; echo "/>
                <span>Soiree</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"tattoo\" value=\"101\""; if ($interest['tattoo'] == 1) echo 'checked'; echo "/>
                <span>Tattoo</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"musique\" value=\"101\""; if ($interest['musique'] == 1) echo 'checked'; echo "/>
                <span>Musique</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"lecture\" value=\"101\""; if ($interest['lecture'] == 1) echo 'checked'; echo "/>
                <span>Lecture</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"theatre\" value=\"101\""; if ($interest['theatre'] == 1) echo 'checked'; echo "/>
                <span>Théâtre</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"religion\" value=\"101\""; if ($interest['religion'] == 1) echo 'checked'; echo "/>
                <span>Religion</span>
            </label>
        </p>
        <input type=\"hidden\" name=\"data_modif\" value=\"ok\">
        <div class=\"col s12\" style=\"text-align: right\">
            <button class=\"btn-large waves-effect waves-light pink accent-3\" type=\"submit\" name=\"submit\"
                    value=\"Créer mon profil\">Mettre à jour
                <i class=\"material-icons right\">send</i>
            </button>
        </div>
    </form>
    ";

    ?>

</main>

<script src="assets/js/materialize.js"></script>
<script>
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
    });
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