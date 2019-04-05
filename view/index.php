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

<div id="background">
</div>

<script>

</script>

<script src="assets/js/materialize.js"></script>
</body>