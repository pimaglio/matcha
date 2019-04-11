<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-09
 * Time: 22:42
 */

if (!isset($_SESSION))
    session_start();

function recup_location_arr()
{
    $loc = new location([]);
    $user = $loc->recup_lat_long();
    $all = $loc->all_loc();
    $return = [];
    $i = 0;
    foreach ($all as $k => $v) {
        if (($meter = location::distance($user['lat'], $user['long'],
                $v['lat'], $v['long'])) <= 300) {
            $return[$i]['id'] = $v['id_usr'];
            $return[$i]['dist'] = $meter;
            $i++;
        }
    }
    return $return;
}

function recup_interest_arr(){
    $infos = new infos([]);
    $user = recup_inter();
    unset($user['id']);
    foreach ($user as $k => $v){
        if ($v != 1)
            unset($user[$k]);
    }
    $all = $infos->all_inter();
    foreach ($all as $k =>$v){
        unset ($all[$k]['id']);
    }
    foreach ($all as $k => $v){
        $arr = $all[$k];
        foreach ($arr as $k1 => $v1){
            if ($v1 == 0)
                unset($all[$k][$k1]);
        }
    }
    $return = [];
    foreach ($all as $k => $v){
        $int = 0;
        foreach ($v as $k1 => $v1) {
            foreach ($user as $k2 => $v2) {
                if ($k1 == $k2)
                    $int += 1;
            }
        }
        if ($int >= 3)
            $return[] = $all[$k]['id_usr'];
    }
    return $return;
}

function recup_popularite_arr(){
    $infos = new infos([]);
    $arr = $infos->recup_popu_suggest();
    return $arr;
}