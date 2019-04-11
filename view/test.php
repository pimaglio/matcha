<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-11
 * Time: 03:22
 */
require '../vendor/autoload.php';
use GeoIp2\Database\Reader;
var_dump($_SERVER);

$ip = '172.18.0.1';
// City DB
$reader = new Reader('../GeoLite2-City.mmdb');
$record = $reader->city($ip);
// or for Country DB
// $reader = new Reader('/path/to/GeoLite2-Country.mmdb');
// $record = $reader->country($_SERVER['REMOTE_ADDR']);
print($record->country->isoCode . "\n");
print($record->country->name . "\n");
print($record->country->names['zh-CN'] . "\n");
print($record->mostSpecificSubdivision->name . "\n");
print($record->mostSpecificSubdivision->isoCode . "\n");
print($record->city->name . "\n");
print($record->postal->code . "\n");
print($record->location->latitude . "\n");
print($record->location->longitude . "\n");