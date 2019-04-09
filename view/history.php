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

<div class="container">
    <div class="user_history">

        <table class="striped">
            <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Date</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Alvin</td>git
                <td>$0.87</td>
            </tr>
            </tbody>
        </table>

    </div>
</div>

<script>

</script>

<script src="assets/js/materialize.js"></script>
</body>