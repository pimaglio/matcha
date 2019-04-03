<?php
/**
 * Created by PhpStorm.
 * User: johndoe
 * Date: 2019-02-16
 * Time: 20:43
 */

include('header.php');
include('../controllers/UsersDataController.php');

if (!isset($_SESSION)) {
    header('Location: ../index.php');
}

if (!isset($_SESSION['loggued_on_user']))
    header('Location: ../index.php');
if (isset($_GET['id'])){
    if (isPicture($_GET['id']) === 0)
        header('Location: ../index.php');

}

if (!isset($_SESSION['loggued_on_user']) && !isset($_GET['id']))
    header('Location: ../index.php');
if (empty($_GET['id']))
    header('Location: ../index.php');
$_USER = $_SESSION['loggued_on_user'];
?>
<body class="body2">

<div id="background">
</div>
<div class="bg-indigo-darkest text-center py-4 lg:px-4">
    <a href="home.php"
       class="p-2 bg-indigo-darker items-center text-indigo-lightest leading-none lg:rounded-full flex lg:inline-flex"
       role="alert">
        <span class="flex rounded-full bg-indigo uppercase px-2 py-1 text-xs font-bold mr-3"><i
                    class="fas fa-long-arrow-alt-left"></i></span>
        <span class="mr-2 text-left flex-auto">Revenir en arrière</span>
    </a>
</div>

<div class="flex flex-resp">
    <div class="container-photo">
        <?php
        $pic = $_GET['id'];
        echo "<img id='img-single' alt='photo_user' src='../upload/$pic.png'>"; ?>
        <div class="flex-1 text-grey-darker text-center px-4">
            <h3 class="title-com">Laisser un commentaire</h3>
            <?php
            $pic5 = htmlspecialchars($_GET['id']);
            $user = $_SESSION['loggued_on_user'];
            echo "
            <form action=\"../controllers/UsersDataController.php\" method=\"post\">
            <input type='hidden' name='id' value='$pic5'>
            <textarea id='input-com' name='comment'></textarea>
            <button type=\"submit\" class=\"bg-indigo-darkest hover:bg-blue text-white font-light hover:text-white py-2 px-4 hover:border-transparent rounded mx-2 btn-com2\">
                    <i class=\"fas fa-share-square\"></i>
            </button>
            </form>
            ";
            ?>
        </div>
    </div>
    <div class="flex-1 comment2 text-grey-darker text-center px-4 py-2 m-2">
        <?php
        $pic5 = $_GET['id'];
        $cmt = getComment($pic5);
        if ($cmt) {
            foreach ($cmt as $key => $value) {
                if (!empty($key)) {
                    if ($_SESSION['loggued_on_user'] == $value) {
                        echo "<div class=\"flex-1 container-com\">
                    <p class='title-com' ><i class=\"far fa-user icon\"></i>$value</p>
                    <p>$key</p>
                    <form class='btn-dl-com' action=\"../controllers/UsersDataController.php\" method=\"post\">
                        <input type='hidden' name='pic-com' value='$pic5'>
                        <input type='hidden' name='com' value='$key'>
                        <button class=\"bg-indigo-darkest hover:bg-pink-dark text-white font-light hover:text-white py-2 px-4 hover:border-transparent rounded mx-2 \"><i class=\"fas fa-trash-alt\"></i></button>
                    </form>
                    </div>";
                    } else
                        echo "<div class=\"flex-1 container-com\">
                    <p class='title-com' ><i class=\"far fa-user icon\"></i>$value</p>
                    <p>$key</p>
                    </div>";
                }
            }
        }
        else
            echo "
                <div class=\"flex-1 container-com\">
                <p>Il n'y a pas encore de commentaire.</p>
                </div>";
        ?>
    </div>
</div>

</body>
</html>
