<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-10
 * Time: 00:45
 */

require '../models/UsersModel2.php';

if (isset($_POST['research']) && $_POST['research'] === 'ok' && isset($_POST['agemin'])
&& isset($_POST['agemax']) && isset($_POST['popmin']) && isset($_POST['distmax'])){
    if (htmlspecialchars($_POST['research']) != $_POST['research'] || htmlspecialchars($_POST['agemin']) != $_POST['agemin']
    || htmlspecialchars($_POST['agemax']) != $_POST['agemax'] || htmlspecialchars($_POST['popmin']) != $_POST['popmin']
    || htmlspecialchars($_POST['distmax']) != $_POST['distmax']){
        echo 'merde';
    }
    $infos = new infos([]);
    $arr = $infos->research_age($_POST['agemin'], $_POST['agemax']);
    foreach ($arr as $k => $v){
        $pop = $infos->recup_pop($v['id_usr']);
        if ($pop <= $_POST['popmin'])
            unset ($arr[$k]);
    }
    var_dump($arr);
    $loc = new location([]);
}