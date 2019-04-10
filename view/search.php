<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 11:59
 */
session_start();
if (isset($_SESSION['loggued_but_not_complet']))
    header("Location: createprofile.php");

if (!isset($_SESSION['loggued_on_user']))
    header("Location: ../index.php");

include('header_connect.php');
include('../controllers/SuggestController.php');
?>

<body>

<div id="background">
</div>

<div class="container">

    <div class="search_container row">
        <form method="get" action="search.php">

            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-numeric-down icon_spacing2"></i>Âge minimum</p>
                <p class="range-field">
                    <input name="popularite" type="range" id="test5" min="18" max="116"/>
                </p>
            </div>


            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-numeric-up icon_spacing2"></i>Âge maximum</p>
                <p class="range-field">
                    <input name="popularite" type="range" id="test5" min="18" max="116"/>
                </p>
            </div>

            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-amount-up icon_spacing2"></i>Popularité minimum</p>
                <p class="range-field">
                    <input name="popularite" type="range" id="test5" min="0" max="10000"/>
                </p>
            </div>

            <div class="col s3">
                <p class="fw100"><i class="fas fa-street-view icon_spacing2"></i>Distance maximum (km)</p>
                <p class="range-field">
                    <input name="location" type="range" id="test5" min="0" max="100"/>
                </p>
            </div>

            <div style="position: relative" class="col s12">
                <p class="fw100"><i class="fas fa-sort-amount-up icon_spacing2"></i>Centre(s) d'intérêt(s)</p>
                <div class="row">
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="sport" value="101"/>
                            <span>Sport</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="voyage" value="101"/>
                            <span>Voyage</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="vegan" value="101"/>
                            <span>Vegan</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="geek" value="101"/>
                            <span>Geek</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="soiree" value="101"/>
                            <span>Soiree</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="tattoo" value="101"/>
                            <span>Tattoo</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="musique" value="101"/>
                            <span>Musique</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="lecture" value="101"/>
                            <span>Lecture</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="theatre" value="101"/>
                            <span>Théâtre</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="religion" value="101git "/>
                            <span>Religion</span>
                        </label>
                    </p>
                </div>
                <div class="btn_search">
                    <button class="btn-large waves-effect waves-light pink accent-3 fade-in four">Rechercher
                        <i class="material-icons right">search</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>

<div class="row search_result">

    <div style="padding-top: 50px;" id="tab1" class="col s12">

        <?php
        $res = recup_popularite_arr();
        foreach ($res as $key => $value) {
            $user = recup_user_id($value['id_usr']);
            $data = recup_data_id($value['id_usr']);
            $inter = recup_inter_id($value['id_usr']);
            $sex = '';
            $orientation = '';
            switch ($data['sex']) {
                case 0:
                    $sex = 'Non binaire';
                    break;
                case 1:
                    $sex = 'Femme';
                    break;
                case 2:
                    $sex = 'Homme';
                    break;
                case 3:
                    $sex = 'Transsexuelle';
                    break;
                case 4:
                    $sex = 'Transsexuel';
                    break;
                case 5:
                    $sex = 'Intersexuel';
                    break;
            }
            switch ($data['orientation']) {
                case 0:
                    $orientation = 'Bisexuel';
                    break;
                case 1:
                    $orientation = 'Hétérosexuel';
                    break;
                case 2:
                    $orientation = 'Homosexuel';
                    break;
                case 3:
                    $orientation = 'Altersexuel';
                    break;
                case 4:
                    $orientation = 'Pansexuel';
                    break;
                case 5:
                    $orientation = 'Asexuel';
                    break;
                case 6:
                    $orientation = 'Sapiosexuel';
                    break;
            }
            if ($user['statut'] == 1) {
                $class_statut = 'connected';
            }
            else
                $class_statut = 'deconnected';
            echo "
            <a style='color: inherit !important;' href='profile.php?id=" . $value['id_usr'] . "'><div class=\"col s12 m6 l3 card_search\">
                <div class=\"card fade-in two\">
                    <div class=\"card-image\">
                        <img src=\"assets/images/fakeuser.jpg\">
                        <span class=\"card-title\">" . $user['login'] . "</span>                
                    </div>
                    <div class=\"card-content\">
                        <h6>
                            " . $user['nom'] . ", <span class=\"fw100\">" . $data['age'] . " ans</span>
                        </h6>
                        <p class=\"fw100\">" . $data['location'] . ", France</p>
                        <div class=\"row\">
                            <div class=\"container center\" style=\"margin-top: 20px; margin-bottom: 20px\">
                                <b class=\"info_sub_profil\"><i class=\"fas fa-star icon_spacing\"></i>" . $data['popularite'] . "</b>
                            </div>
                            <div class=\"col s6 left\">
                                <p class=\"fw100 left\"><i class=\"fas fa-venus-mars icon_spacing\"></i>$sex</p>
                            </div>
                            <div class=\"col s6 right\">
                                <p class=\"fw100 right\"><i class=\"fas fa-search icon_spacing\"></i>$orientation</p>
                            </div>
                        </div>
                        <div class=\"container center\">
                            <p><i class=\"fas fa-circle $class_statut\"></i> " . $user['statut'] . "</p>
                        </div>
                    </div>
                </div>
            </div></a>
            ";
        }
        ?>

    </div>

</div>

<script>
    $(document).ready(function () {
        $('.tabs').tabs();
    });
    $(document).ready(function () {
        $('select').formSelect();
    });
</script>


<script src="assets/js/materialize.js"></script>

</body>