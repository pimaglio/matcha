<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 17:12
 */

include('header.php');
include('../controllers/UsersDataController.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['loggued_on_user']))
    header('Location: ../index.php');
$_USER = $_SESSION['loggued_on_user'];
if (isset($_SESSION['alert'])) {
    if ($_SESSION['alert'] === 'success') {
        echo "<button class='msg-success'><i class=\"fas fa-user-check icon\"></i>Vous êtes connecté, Bienvenue $_USER</button>";
        echo "<div class='bg-over'></div>";
        header("Refresh:3");
        unset($_SESSION['alert']);
    }
}
if (isset($_SESSION['error']) && $_SESSION['error'] == 7)
{
    echo "<button class='msg-error'><i class=\"fas fa-envelope icon\"></i>Fichiers autorisés: *.png - *.jpeg - *.gif</button>";
    echo "<div class='bg-over'></div>";
    header("Refresh:3");
    unset($_SESSION['error']);
}

if (isset($_SESSION['error']) && $_SESSION['error'] == 8)
{
    echo "<button class='msg-error'><i class=\"fas fa-envelope icon\"></i>Fichiers trop volumineux ( > 8mb )</button>";
    echo "<div class='bg-over'></div>";
    header("Refresh:3");
    unset($_SESSION['error']);
}

if (isset($_SESSION['error']) && $_SESSION['error'] == 9)
{
    echo "<button class='msg-error'><i class=\"fas fa-envelope icon\"></i>Fichier Introuvable</button>";
    echo "<div class='bg-over'></div>";
    header("Refresh:3");
    unset($_SESSION['error']);
}

if (isset($_SESSION['error']) && $_SESSION['error'] == 15)
{
    echo "<button class='msg-error'><i class=\"fas fa-envelope icon\"></i>Deja Like</button>";
    echo "<div class='bg-over'></div>";
    header("Refresh:3");
    unset($_SESSION['error']);
}

?>
<body>

<div id="background">
</div>

<div class="flex flex-resp">
    <div style="" class="flex-1 text-grey-darker text-center px-4 py-2 m-2">

        <div class="flex flex-resp2 rounded container-pic">
            <div class="image-left flex-1 text-grey-darker text-center adhoc">
                <canvas id="canvas2" style="position: absolute; left: 0; top: 0; right: 0; margin: auto; z-index: 50;"></canvas>
                <canvas id='canvastest' style="position: absolute; left: 0; top: 0; right: 0; margin: auto; z-index: 0;"></canvas>
                <?php
                    echo "<video id='video-bg' playsinline autoplay></video>";
                    echo "<button class=\"btn-pic\" id=\"btn-take\" type=\"button\" onclick=\"take()\" disabled><i class=\"fas fa-camera icon\"></i>Capturer</button>";
                ?>
            </div>
            <div class="image-right flex-1 text-grey-darker text-center adhoc">
                <canvas id="canvas" class="nocanvas"></canvas>
                <button class="btn-pic-alt" id="btn-save" onclick="UploadPic()" value="Upload" type="button" disabled><i
                            class="fas fa-save icon"></i>Sauvegarder
                </button>
                <form method="post" accept-charset="utf-8" name="form1">
                    <input name="hidden_data" id='hidden_data' type="hidden"/>
                </form>
            </div>
        </div>
        <div class="flex rounded">
            <div class="container-up flex-1 text-grey-darker text-center m-2 adhoc">
                <div class="upload-pic inline-block relative w-64">
                    <form method="POST" name="form1" enctype="multipart/form-data"
                          action="../controllers/UsersDataController.php">
                        <p>
                        <h2 class="title-form">Choisir le fond</h2>
                        <input type="file" id="fichier" name="fichier" size="30000" accept="image">
                        </p>
                    </form>
                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-4 text-grey-darker">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
                <div style="display: contents" class="upload-pic inline-block relative w-64">
                    <h2 class="title-form">Filtres disponibles</h2>
                    <img class="img-filter" src="../upload/filter/dog.png" alt="dog" onclick="draw1(this.src)">
                    <img class="img-filter" src="../upload/filter/cat.png" alt="cat" onclick="draw1(this.src)">
                    <img class="img-filter" src="../upload/filter/lang.png" alt="lang" onclick="draw1(this.src)">
                    <img class="img-filter" src="../upload/filter/diable.png" alt="diable" onclick="draw1(this.src)">
                    <img class="img-filter" src="../upload/filter/birds.png" alt="birds" onclick="draw1(this.src)">
                    <img class="img-filter" src="../upload/filter/biche.png" alt="biche" onclick="draw1(this.src)">
                    <img class="img-filter" src="../upload/filter/101.png" alt="101" onclick="draw1(this.src)">

                </div>
            </div>
        </div>
    </div>
    <div style="width: 400px;" class="flex-initial flex-col text-grey-darker text-center bg-whitepy-2 scroll">
    </br>
        <h2 class="title-form">Photos récentes</h2>
        <?php

        $val = getPicture();
        if ($val) {

            foreach ($val as $key) {
                $title = $key;
                $nblikes = getNbLikes($key);
                $like = "<form style='display: inline-grid; margin: .5rem;' action=\"../controllers/UsersDataController.php\" method=\"post\">
            <input type='hidden' name='id' value='$key'>
            <input type='hidden' name='url' value='home.php'>
            <button name='like' value='ok' class=\"notif\">
            <span class=\"num\">$nblikes</span>
            </button>
            </form>";
                echo "<div class=\"h-auto rounded overflow-hidden shadow-lg bg-white m-8\" style='position: relative'>
            <img class=\"h-64 w-auto\" src=\"../upload/$key.png\" alt=\"Photo de moi\">
            <div class=\"bg-white \" style='padding-bottom: 20px'>
            <h4 style='padding-bottom: 10px; color: #22292f'>Photo <span style='color: #eb5286'>#$title</span></h4>
            <div class='item-top'>
            <form class='btn-dl' action=\"../controllers/UsersDataController.php\" method=\"post\">
            <input type='hidden' name='pic' value='$key'>
            <input type='hidden' name='url' value='home.php'>
                <button class=\"bg-white hover:bg-pink-dark text-indigo-darkest font-light hover:text-white py-2 px-4 hover:border-transparent rounded mx-2 \">
                    <i class=\"fas fa-trash-alt\"></i>
                </button>
                </form>
                <br><br>
                </div>
                $like
                <button class=\"bg-indigo-darkest hover:bg-indigo-dark text-white hover:text-white py-2 px-4 border border-indigo-darkest hover:border-transparent rounded mx-2 \" onclick=\"javascript:genericSocialShare('$key')\">
                    <i class=\"fab fa-facebook-f\"></i>
                </button>
                <button onclick=\"window.location.href='photo.php?id=$key'\" class=\"hover:bg-blue-dark  bg-indigo-darkest text-white hover:text-white py-2 px-4 border hover:border-blue-dark border-indigo-darkest rounded mx-2 \">
                    <i class=\"far fa-comments icon\"></i>Comment
                </button>
            </div>
        </div>";
            }
        }
        ?>
    </div>
</div>

<?php
if (!isset($_SESSION['img_up']))
    echo "<script src=\"assets/js/camera.js\"></script>";
?>
<script src="assets/js/filter.js"></script>
<script src="assets/js/script.js"></script>

</body>
</html>
