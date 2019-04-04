<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 12:03
 */

session_start();
unset($_SESSION);
session_destroy();
header('Location: ../index.php');
?>