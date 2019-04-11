<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-09
 * Time: 22:42
 */

if (!isset($_SESSION))
    session_start();

function orientation($arr)
{
    $infos = new infos([]);
    $inf = $infos->recup_sex_ori();
    if ($inf['orientation'] == 0 || $inf['orientation'] == 3 || $inf['orientation'] == 4
        || $inf['orientation'] == 5 || $inf['orientation'] == 6 || $inf['sex'] == 0 || $inf['sex'] == 5)
        return $arr;
    else if ($inf['orientation'] == 1) {
        if ($inf['sex'] == 2 || $inf['sex'] == 4) {
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v['id'])) == 2 || ($sex = $infos->recup_sex($v['id'])) == 4)
                    unset ($arr[$k]);
            }
            return ($arr);
        } else if ($inf['sex'] == 1 || $inf['sex'] == 3)
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v['id'])) == 1 || ($sex = $infos->recup_sex($v['id'])) == 3)
                    unset ($arr[$k]);
            }
        return ($arr);
    } else if ($inf['orientation'] = 2) {
        if ($inf['sex'] == 2 || $inf['sex'] == 4) {
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v['id'])) == 1 || ($sex = $infos->recup_sex($v['id'])) == 3)
                    unset ($arr[$k]);
            }
            return ($arr);
        } else if ($inf['sex'] == 1 || $inf['sex'] == 3)
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v['id'])) == 2 || ($sex = $infos->recup_sex($v['id'])) == 4)
                    unset ($arr[$k]);
            }
        return ($arr);
    }
    return $arr;
}

function orientation_usr($arr)
{
    $infos = new infos([]);
    $inf = $infos->recup_sex_ori();
    if ($inf['orientation'] == 0 || $inf['orientation'] == 3 || $inf['orientation'] == 4
        || $inf['orientation'] == 5 || $inf['orientation'] == 6 || $inf['sex'] == 0 || $inf['sex'] == 5)
        return $arr;
    else if ($inf['orientation'] == 1) {
        if ($inf['sex'] == 2 || $inf['sex'] == 4) {
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v['id_usr'])) == 2 || ($sex = $infos->recup_sex($v['id_usr'])) == 4)
                    unset ($arr[$k]);
            }
            return ($arr);
        } else if ($inf['sex'] == 1 || $inf['sex'] == 3)
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v['id_usr'])) == 1 || ($sex = $infos->recup_sex($v['id_usr'])) == 3)
                    unset ($arr[$k]);
            }
        return ($arr);
    } else if ($inf['orientation'] = 2) {
        if ($inf['sex'] == 2 || $inf['sex'] == 4) {
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v['id_usr'])) == 1 || ($sex = $infos->recup_sex($v['id_usr'])) == 3)
                    unset ($arr[$k]);
            }
            return ($arr);
        } else if ($inf['sex'] == 1 || $inf['sex'] == 3)
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v['id_usr'])) == 2 || ($sex = $infos->recup_sex($v['id_usr'])) == 4)
                    unset ($arr[$k]);
            }
        return ($arr);
    }
    return $arr;
}

function orientation_int($arr)
{
    $infos = new infos([]);
    $inf = $infos->recup_sex_ori();
    if ($inf['orientation'] == 0 || $inf['orientation'] == 3 || $inf['orientation'] == 4
        || $inf['orientation'] == 5 || $inf['orientation'] == 6 || $inf['sex'] == 0 || $inf['sex'] == 5)
        return $arr;
    else if ($inf['orientation'] == 1) {
        if ($inf['sex'] == 2 || $inf['sex'] == 4) {
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v)) == 2 || ($sex = $infos->recup_sex($v)) == 4)
                    unset ($arr[$k]);
            }
            return ($arr);
        } else if ($inf['sex'] == 1 || $inf['sex'] == 3)
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v)) == 1 || ($sex = $infos->recup_sex($v)) == 3)
                    unset ($arr[$k]);
            }
        return ($arr);
    } else if ($inf['orientation'] = 2) {
        if ($inf['sex'] == 2 || $inf['sex'] == 4) {
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v)) == 1 || ($sex = $infos->recup_sex($v)) == 3)
                    unset ($arr[$k]);
            }
            return ($arr);
        } else if ($inf['sex'] == 1 || $inf['sex'] == 3)
            foreach ($arr as $k => $v) {
                if (($sex = $infos->recup_sex($v)) == 2 || ($sex = $infos->recup_sex($v)) == 4)
                    unset ($arr[$k]);
            }
        return ($arr);
    }
    return $arr;
}

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
    $return = orientation($return);
    return $return;
}

function recup_interest_arr()
{
    $infos = new infos([]);
    $user = recup_inter();
    unset($user['id']);
    foreach ($user as $k => $v) {
        if ($v != 1)
            unset($user[$k]);
    }
    $all = $infos->all_inter();
    foreach ($all as $k => $v) {
        unset ($all[$k]['id']);
    }
    foreach ($all as $k => $v) {
        $arr = $all[$k];
        foreach ($arr as $k1 => $v1) {
            if ($v1 == 0)
                unset($all[$k][$k1]);
        }
    }
    $return = [];
    foreach ($all as $k => $v) {
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
    $return = orientation_int($return);
    return $return;
}

function recup_popularite_arr()
{
    $infos = new infos([]);
    $arr = $infos->recup_popu_suggest();
    $arr = orientation_usr($arr);
    return $arr;
}