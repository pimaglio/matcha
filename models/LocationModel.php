<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-09
 * Time: 16:45
 */

class location
{
    private $ville;
    private $zipcode;
    private $lat;
    private $longi;
    private $arrond;
    private $db_con;

    public function __construct($arr)
    {
        if (array_key_exists('0', $arr))
            $this->ville = $arr['0'];
        if (array_key_exists('1', $arr))
            $this->zipcode = $arr['1'];
        if (array_key_exists('2', $arr))
            $this->lat = $arr['2'];
        if (array_key_exists('3', $arr))
            $this->longi = $arr['3'];
        if (array_key_exists('4', $arr))
            $this->arrond = $arr['4'];
        $this->db_con = database_connect();
    }

    public function add_loc($id){
        $query = 'INSERT INTO location (id_usr, ville, zipcode, lat, `long`, arrondissement) VALUES (:id, :ville, :zip, :lat, :longi, :arron )';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $id,
            ":ville" => $this->ville,
            ":zip" => $this->zipcode,
            ":lat" => $this->lat,
            ":longi" => $this->longi,
            ":arron" => $this->arrond
        ));
    }
}