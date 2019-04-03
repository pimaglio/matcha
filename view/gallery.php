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

if (!isset($_GET['page']) && $_GET['page'] < 2 )
    header('location: gallery.php?page=1')

?>
<body>
<div class="anim flex content-start flex-wrap bg-grey-lighter">
    <?php

    if (isset($_GET['page']) && $_GET['page'] > 1){
        $page = ($_GET['page'] - 1) * 6;

    }
    else
        $page = 0;
    $val = getPictureGal($page);
    $_SESSION['count'] = $val['count'];
    unset($val['count']);
    if ($val) {

        foreach ($val as $key => $value) {
            $title = $key;
            $nblikes = getNbLikes($key);

            if (isset($_SESSION['loggued_on_user']) && $value == $_SESSION['loggued_on_user'])
                $btn_del = "<form class='btn-dl' action=\"../controllers/UsersDataController.php\" method=\"post\">
    <input type='hidden' name='pic' value='$key'>
    <input type='hidden' name='url' value='gallery.php'>
    <button class=\"bg-white hover:bg-pink-dark text-indigo-darkest font-light hover:text-white py-2 px-4 hover:border-transparent rounded mx-2\">
    <i class=\"fas fa-trash-alt\"></i>
    </button>
</form>";
            else
                $btn_del = "";
            $like = "<form style='display: inline-grid; margin: .5rem;' action=\"../controllers/UsersDataController.php\" method=\"post\">
            <input type='hidden' name='id' value='$key'>
            <input type='hidden' name='url' value='gallery.php'>
            <button name='like' value='ok' class=\"notif\">
            <span class=\"num\">$nblikes</span>
            </button>
            </form>";

            if (isset($_SESSION['loggued_on_user'])) {
                echo "<div class=\"w-1/3 image-gal h-auto rounded overflow-hidden shadow-lg bg-white m-12\" style='position: relative; text-align: center'>
            <img class=\"h-64 w-auto\" src=\"../upload/$key.png\" alt=\"Photo de moi\">
            <div class=\"bg-white \" style='padding-bottom: 20px'>
            <h4 style='padding-bottom: 10px; color: #22292f'>Photo <span style='color: #eb5286'>#$value</span></h4>
            <div class='item-top'>
            $btn_del
                <br><br>
                </div>
                $like
                </button>
                <button class=\"bg-indigo-darkest hover:bg-indigo-dark text-white hover:text-white py-2 px-4 border border-indigo-darkest hover:border-transparent rounded mx-2 \" onclick=\"javascript:genericSocialShare('$key')\">
                    <i class=\"fab fa-facebook-f\"></i>
                </button>
                <button onclick=\"window.location.href='photo.php?id=$key'\" class=\"bg-blue-dark  hover:bg-indigo-darkest text-white hover:text-white py-2 px-4 border border-blue-dark hover:border-indigo-darkest rounded mx-2 \">
                    <i class=\"far fa-comments icon\"></i>Comment
                </button>
            </div>
        </div>";
            } else {
                echo "<div class=\"w-1/3 image-gal h-auto rounded overflow-hidden shadow-lg bg-white m-12\" style='position: relative; text-align: center'>
            <img class=\"h-64 w-auto\" src=\"../upload/$key.png\" alt=\"Photo de moi\">
            <div class=\"bg-white \" style='padding-bottom: 20px'>
            <h4 style='padding-bottom: 10px; color: #22292f'>Photo <span style='color: #eb5286'>#$title</span></h4>
                <button class=\"bg-indigo-darkest hover:bg-indigo-dark text-white hover:text-white py-2 px-4 border border-indigo-darkest hover:border-transparent rounded mx-2 \" onclick=\"javascript:genericSocialShare('$key')\">
                    Share on <i class=\"fab fa-facebook-f\"></i>
                </button>
            </div>
        </div>";
            }
        }
    } else
        echo "
                <div style='text-align: center;max-width: 310px;margin-bottom: 7%;color: #eb5286;' class=\"flex-1 container-com\">
                <i class=\"fas fa-frown fa-3x\"></i><p>Il n'y a pas encore de photo.</p>
                </div>";
    ?>
</div>

<div class="center">
    <div class="pagination">
        <?php
        $ct = 1;
        $page_total = ceil($_SESSION['count'] / 6);
        unset($_SESSION['count']);

        while ($ct <= $page_total){
            $ct_m = $ct - 1;
            $ct_p = $ct + 1;
            if ($_GET['page'] == $ct)
                $class = 'active';
            else
                $class = '';
            if (!$_GET['page'] === 1)
                echo "<a href=\"gallery.php?page=$ct_m\">&laquo;</a>";
            echo "<a class='$class' href=\"gallery.php?page=$ct\">$ct</a>";
            if (!$ct === $page_total)
                echo "<a href=\"gallery.php?page=$ct_p\">&raquo;</a>";
            $ct++;
        }
        ?>
    </div>
</div>

<script src="assets/js/script.js"></script>

</body>
</html>
