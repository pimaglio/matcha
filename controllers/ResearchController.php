<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-10
 * Time: 00:45
 */

require '../models/UsersModel2.php';
require '../models/LocationModel.php';

//if (isset($_POST['research']) && $_POST['research'] === 'ok' && isset($_POST['agemin'])
//    && isset($_POST['agemax']) && isset($_POST['popmin']) && isset($_POST['distmax'])) {
//    if (htmlspecialchars($_POST['research']) != $_POST['research'] || htmlspecialchars($_POST['agemin']) != $_POST['agemin']
//        || htmlspecialchars($_POST['agemax']) != $_POST['agemax'] || htmlspecialchars($_POST['popmin']) != $_POST['popmin']
//        || htmlspecialchars($_POST['distmax']) != $_POST['distmax']) {
//        echo 'merde';
//    }
//    $infos = new infos([]);
//    $arr = $infos->research_age($_POST['agemin'], $_POST['agemax']);
//    foreach ($arr as $k => $v) {
//        $pop = $infos->recup_pop($v['id_usr']);
//        if ($pop <= $_POST['popmin'])
//            unset ($arr[$k]);
//    }
//    $loc = new location([]);
//    $user = $loc->recup_lat_long();
//    foreach ($arr as $k => $v) {
//        $dist = $loc->recup_lat_long_id($v['id_usr']);
//        if (($meter = location::distance(intval($user['lat']), intval($user['long']),
//                intval($dist['lat']), intval($dist['long']))) > $_POST['distmax']) {
//            unset ($arr[$k]);
//        }
//    }
//    var_dump($arr);
//}

function search($agemin, $agemax, $popmin, $distmax, $arr)
{
    if (htmlspecialchars($agemin) != $agemin || htmlspecialchars($agemax) != $agemax
        || htmlspecialchars($popmin) != $popmin || htmlspecialchars($distmax) != $distmax) {
        header('Location: ../view/search.php?error=script');
        exit ();
    }
    foreach ($arr as $k => $v) {
        if (htmlspecialchars($v) != $v) {
            header('Location: ../view/search.php?error=script');
            exit ();
        }
    }
    $infos = new infos([]);
    $array = $infos->research_age($agemin, $agemax);
    foreach ($array as $k => $v) {
        $pop = $infos->recup_pop($v['id_usr']);
        if ($pop <= $popmin)
            unset ($array[$k]);
    }
    $loc = new location([]);
    $user = $loc->recup_lat_long();
    foreach ($array as $k => $v) {
        $dist = $loc->recup_lat_long_id($v['id_usr']);
        if (($meter = location::distance(intval($user['lat']), intval($user['long']),
                intval($dist['lat']), intval($dist['long']))) > $distmax) {
            unset ($array[$k]);
        }
    }
    var_dump($array);

}