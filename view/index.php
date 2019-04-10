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

<div class="container_s">
    <div class="row result">

        <div class="col s12 center">
            <ul class="tabs">
                <li class="tab col s4"><a class="active" href="#tab1">Autour de moi</a></li>
                <li class="tab col s4"><a href="#tab2">Hobbie</a></li>
                <li class="tab col s4 "><a href="#tab3">Populaire</a></li>
            </ul>
        </div>
        <div style="padding-top: 50px;" id="tab1" class="col s12">
            <?php
            $res = recup_popularite_arr();
            foreach ($res as $key => $value) {
                $user = recup_user_id($value['id_usr']);
                $data = recup_data_id($value['id_usr']);
                $inter = recup_inter_id($value['id_usr']);
                $sex = '';
                $orientation = '';
                if ($user['statut'] == 1){
                    $icon_statut = 'connected';
                    $statut = 'Connecté';
                }
                else{
                    $icon_statut = 'deconnected';
                    $statut = $user['statut'];
                }
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
                echo "
            <a style='color: inherit !important;' href='profile.php?id=" . $value['id_usr'] . "'><div class=\"col s12 m6 l3 card_profil\">
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
                            <p><i class=\"fas fa-circle $icon_statut\"></i> $statut</p>
                        </div>
                    </div>
                </div>
            </div></a>
            ";
            }
            ?>

        </div>
        <div style="padding-top: 50px;" id="tab2" class="col s12">Test 2</div>
        <div style="padding-top: 50px;" id="tab3" class="col s12">Test 3</div>


    </div>
</div>

<script>
    $(document).ready(function () {
        $('.tabs').tabs();
    });
</script>

<script src="assets/js/materialize.js"></script>
</body>