<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-11
 * Time: 01:53
 */
function add_popularite($id, $i){
    $infos = new infos([]);
    $pop_base  = $infos->find_pop($id);
    echo $pop_base;
    $pop_base += $i;
    echo $pop_base;
    $infos->modif_pop($pop_base, $id);
}