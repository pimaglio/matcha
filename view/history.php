<?php

session_start();
if (isset($_SESSION['loggued_but_not_complet']))
    header("Location: createprofile.php");

if (!isset($_SESSION['loggued_on_user']))
    header("Location: ../index.php");

include('header_connect.php');
?>

<body>
<div id="background"></div>

<div class="container fade-in three">
    <div class="user_history">
        <div class="row">
            <div class="col s12 panel_info">
                <div class="icon_history"></div>
                <h2 class="title-form-alt">Historique<br><span class="title-form">des visites</span></h2>
            </div>
        </div>
        <table class="striped">
            <thead>
            <tr>
                <th><i class="material-icons left">account_circle</i>Utilisateur</th>
                <th><i class="material-icons left">access_time</i>Date et Heure</th>
            </tr>
            </thead>

            <tbody>
                <?php
         /*       $db2 = new infos([]);*/
                $db = new history(array(
                    'id_usr_h' => $_SESSION['id']
                ));
                $data_history = $db->get_history();
                if (!empty($data_history)){
                    $db_con = new account([]);
                    foreach ($data_history as $key => $value){
                        $user = $db_con->select_login($value['id_usr']);
                        echo "
                    <tr class='fade-in four'>
                    <td>" . $user . "</td>
                    <td>" . $value['date'] . "</td>
                    </tr>
                    ";
                    }
                }
                else
                    echo  "
                    <tr>
                    <td>Aucune visite.</td>
                    </tr>
                    ";
                ?>
            </tbody>
        </table>

    </div>
</div>

<script>

</script>

<script src="assets/js/materialize.js"></script>
</body>