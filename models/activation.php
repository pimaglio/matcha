<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 10:19
 */

include('UsersModel.php');
session_start();
$new = New account(array("empty" => "empty"));
$res = $new->Activation($_GET['cle'],$_GET['login']);
if ($res === 1)
	$_SESSION['alert'] = "Ce compte n'existe pas";
if ($res === 2)
	$_SESSION['alert'] = "Ce compte est deja valide";
if ($res === 3)
	$_SESSION['alert'] = "La cle de validation ne correspond pas!";
if ($res === 0)
{
	$_SESSION['alert'] = 'success';
	header("Location: ../view/home.php");
	return ;
}
header("Location: ../index.php");
?>
