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

include('header.php');
?>

<body>
<?php
$errmdp = 0;
if (isset($_SESSION['error']) && $_SESSION['error'] == 2) {
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Ce nom d'utilisateur existe déjà !</button>";
    unset($_SESSION['error']);
}



if (isset($_SESSION['error']) && $_SESSION['error'] == 6) {
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Cette adresse email existe déjà !</button>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 8) {
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Ce nom d'utilisateur est trop long ! (25 caractères maximum)</button>";
    unset($_SESSION['alert']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 4) {
    $errmdp = 1;
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Mot de pass trop court (6 caractères minimum)</button>";
    unset($_SESSION['alert']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 5) {
    $errmdp = 1;
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Vous devez utiliser 1 caractère spécial (#!$-/=?* .. )</button>";
    unset($_SESSION['alert']);
}

if (isset($_SESSION['alert']) && $_SESSION['alert'] == 7) {
    $errmdp = 1;
    echo "<button class='msg-error2'><i class=\"fas fa-exclamation-circle icon\"></i>Les mots de passes ne correspondent pas</button>";
    unset($_SESSION['alert']);
}

?>
<div id="background">
</div>
<div class="container-form">
    <div class="form_pic"></div>
    <h2 class="title-form">S'inscrire</h2>
    <form id="register-form" method="POST" action="../controllers/UsersController.php" onsubmit="return isValidForm()">
        <p class="title-form2">Login</p>
        <input type="text" name="login" id="login" placeholder="Type your login here" required><br/>
        <p class="title-form2">Email</p>
        <input type="email" name="email" id="email" placeholder="Type your E-mail address"
               required><br/>
        <p class="title-form2">Password</p>
        <input type="password" name="password" id="password" class="<?php if ($errmdp == 1) {
            echo "mdpe";
        } ?>" placeholder="Type your Password" required><br/>
        <p class="title-form2">Password (repeat)</p>
        <input type="password" name="password2" id="repeat_password" class="<?php if ($errmdp == 1) {
            echo "mdpe";
        } ?>" placeholder="Repeat your Password"
               required><br/>
        <input type="submit" name="submit" value="Register" id="submit" class="btn3"/>
        <div id="status"></div>
        <div id="errorContainer"></div>
    </form>
    <p class="connect">Tu es déjà inscrit ? <a class="link" href="login.php">Connecte-toi</a></p>
</div>
</body>