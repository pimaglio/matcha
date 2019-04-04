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
if (isset($_SESSION['alert'])) {
    if ($_SESSION['alert'] === 'success') {
        echo "<button class='msg-success'><i class=\"fas fa-envelope icon\"></i>Un nouveau mot de passe vient de vous être envoyé par email.</button>";
        unset($_SESSION['alert']);
    }
    else {
        echo "<button class='msg-error'><i class=\"fas fa-exclamation-circle icon\"></i>Ce compte n'existe pas.</button>";
        unset($_SESSION['alert']);
    }
}
?>
<div id="background">
</div>



<script src="assets/js/materialize.js"></script>
<script>

</script>

</body>