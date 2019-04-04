<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-04
 * Time: 12:23
 */

include('../config/database.php');
session_start();

class infos
{
    private $age;
    private $sexe;
    private $location;
    private $orientation;
    private $bio;
    private $popularite;
    private $login;
    private $db_con;
    private $id;

    public function __construct(array $user_data)
    {
        $_SESSION['loggued_but_not_valid'] = 'root';
        if (array_key_exists('age', $user_data))
            $this->age = $user_data['age'];
        if (array_key_exists('sexe', $user_data))
            $this->sexe = $user_data['sexe'];
        if (array_key_exists('location', $user_data))
            $this->location = $user_data['location'];
        if (array_key_exists('orientation', $user_data))
            $this->orientation = $user_data['orientation'];
        if (array_key_exists('bio', $user_data))
            $this->bio = $user_data['bio'];
        if (array_key_exists('popularite', $user_data))
            $this->popularite = $user_data['popularite'];
        if (isset($_SESSION['loggued_but_not_valid']))
            $this->login = $_SESSION['loggued_but_not_valid'];
        $this->db_con = database_connect();
        $this->id = $this->find_id();
    }

    public function find_id()
    {
        $array = [];
        $query = 'SELECT id FROM user_db WHERE login=:log';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":log" => $this->login
        ));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($array, $data);
        $array = $array[0];
        return $array['id'];
    }

    public function add_data()
    {
        $query = 'SELECT id FROM `data` WHERE id_usr=:id_usr';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id_usr" => $this->id
        ));
        if (isset($stmt->fetch(PDO::FETCH_ASSOC)['id']))
            return ;
        $query = 'INSERT INTO `data` (id_usr, age, sex, location, orientation, bio) VALUES (:id, :age, :sexe, :loc, :ori, :bio)';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id,
            ":age" => $this->age,
            ":sexe" => $this->sexe,
            ":loc" => $this->location,
            ":ori" => $this->orientation,
            ":bio" => $this->bio
        ));
    }
}