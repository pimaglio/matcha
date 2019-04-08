<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 12:03
 */
include ('../controllers/ProfilsController.php');
if (!isset($_SESSION))
    session_start();
echo $_SESSION['loggued_on_user'];
unlog();
unset($_SESSION);
session_destroy();
header('Location: ../index.php');
?>