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
include ('../controllers/SuggestController.php');
?>

<body>

<div id="background">
</div>

<div class="container">
    <div class="row">

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
            htmldump($res);
            foreach ($res as $key => $value){
                $value['id_usr'];

            }

            echo "
            <div class=\"col s12 m6 l3 card_profil\">
                <div class=\"card fade-in two\">
                    <div class=\"card-image\">
                        <img src=\"assets/images/fakeuser.jpg\">
                        <span class=\"card-title\">Sena</span>
                        <a class=\"btn-floating halfway-fab waves-effect waves-light\"><i class=\"material-icons\">favorite</i></a>
                    </div>
                    <div class=\"card-content\">
                        <h6>
                            Pierre Tarin, <span class=\"fw100\">26ans</span>
                        </h6>
                        <p class=\"fw100\">Marseille, France</p>
                        <div class=\"row\">
                            <div class=\"container center\" style=\"margin-top: 20px; margin-bottom: 20px\">
                                <b class=\"info_sub_profil\"><i class=\"fas fa-star icon_spacing\"></i>456</b>
                                <p>Popularité</p>
                            </div>
                            <div class=\"col s6 left\">
                                <p class=\"fw100 left\"><i class=\"fas fa-venus-mars icon_spacing\"></i>Homme</p>
                            </div>
                            <div class=\"col s6 right\">
                                <p class=\"fw100 right\"><i class=\"fas fa-search icon_spacing\"></i>Babtou</p>
                            </div>
                        </div>
                        <div class=\"container center\">
                            <p><i class=\"fas fa-circle connected\"></i> Connecté</p>
                        </div>
                    </div>
                </div>
            </div>
            ";
            ?>

        </div>
        <div style="padding-top: 50px;" id="tab2" class="col s12">Test 2</div>
        <div style="padding-top: 50px;" id="tab3" class="col s12">Test 3</div>


    </div>
</div>

<script>
    $(document).ready(function(){
        $('.tabs').tabs();
    });
</script>

<script src="assets/js/materialize.js"></script>
</body>