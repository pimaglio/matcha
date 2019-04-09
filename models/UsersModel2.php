<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-04
 * Time: 12:23
 */

include('../config/database.php');
if (!isset($_SESSION))
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
        if (isset($_SESSION['loggued_on_user']))
            $this->login = $_SESSION['loggued_on_user'];
        $this->db_con = database_connect();
//        $this->id = $this->find_id();
        $this->id = 2;
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
            return;
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

    public function add_data2($arr)
    {
        $query = 'SELECT id FROM `data` WHERE id_usr=:id_usr';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id_usr" => $this->id
        ));
        if (isset($stmt->fetch(PDO::FETCH_ASSOC)['id']))
            return;
        $query = 'INSERT INTO `data` (id_usr, age, sex, location, orientation, bio) VALUES (:id, :age, :sexe, :loc, :ori, :bio)';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id,
            ":age" => $this->age,
            ":sexe" => $this->sexe,
            ":loc" => $arr[0],
            ":ori" => $this->orientation,
            ":bio" => $this->bio
        ));
    }

    public function edit_data()
    {
        $query = 'UPDATE data SET age=:age, sex=:sexe, location=:loc, orientation=:ori, bio=:bio WHERE id_usr=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":age" => $this->age,
            ":sexe" => $this->sexe,
            ":loc" => $this->location,
            ":ori" => $this->orientation,
            ":bio" => $this->bio,
            ":id" => $this->id
        ));
    }

    public function addpop($pop)
    {
        $query = 'UPDATE data SET popularite=:pop WHERE id_usr=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":pop" => (int)$pop,
            ":id" => $this->id
        ));
    }

    public function add_interest($arr)
    {
        $query = 'SELECT id_usr FROM `interest` WHERE id_usr=:id_usr';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id_usr" => $this->id
        ));
        if (!isset($stmt->fetch(PDO::FETCH_ASSOC)['id_usr'])) {
            $query = 'INSERT INTO `interest` (id_usr) VALUES (:id)';
            $stmt = $this->db_con->prepare($query);
            $stmt->execute(array(
                ":id" => $this->id
            ));
        }
        foreach ($arr as $k => $v) {
            if ($arr[$k] != 0) {
                $query = 'UPDATE `interest` SET ' . $k . '=1 WHERE id_usr=:id';
                $stmt = $this->db_con->prepare($query);
                $stmt->execute(array(
                    ":id" => $this->id
                ));
            }
        }
    }

    public function profile_complete()
    {
        $login_now = $_SESSION['loggued_on_user'];
        $query = "UPDATE user_db SET profile=:profile WHERE login='$login_now'";
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":profile" => 1
        ));

    }

    public function edit_interest($del, $add)
    {
        foreach ($del as $k => $v) {
            $query = 'UPDATE interest SET ' . $k . '=0 WHERE id_usr=:id';
            $stmt = $this->db_con->prepare($query);
            $stmt->execute(array(
                ":id" => $this->id
            ));
        }
        foreach ($add as $k => $v) {
            $query = 'UPDATE `interest` SET ' . $k . '=1 WHERE id_usr=:id';
            $stmt = $this->db_con->prepare($query);
            $stmt->execute(array(
                ":id" => $this->id
            ));
        }
    }

    public function array_data_id()
    {
        $arr = [];
        $query = 'SELECT * FROM `data` WHERE id_usr=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id
        ));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($arr, $data);
        $arr = $arr[0];
        return $arr;
    }

    public function array_data()
    {
        $arr = [];
        $query = 'SELECT * FROM `data` WHERE id_usr=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id
        ));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($arr, $data);
        $arr = $arr[0];
        return $arr;
    }

    public function array_user()
    {
        $query = 'SELECT * FROM user_db WHERE id=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id
        ));
        return ($fetch = $stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function array_inter()
    {
        $arr = [];
        $query = 'SELECT * FROM `interest` WHERE id_usr=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id
        ));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($arr, $data);
        $arr = $arr[0];
        return $arr;
    }

    public function all_inter()
    {
        $arr = [];
        $query = 'SELECT * FROM `interest` WHERE NOT id_usr=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id
        ));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($arr, $data);
        return $arr;
    }

    public function array_inter_id()
    {
        $arr = [];
        $query = 'SELECT * FROM `interest` WHERE id_usr=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id
        ));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($arr, $data);
        $arr = $arr[0];
        return $arr;
    }

    public function del_user_db()
    {
        $query = 'DELETE FROM user_db WHERE id=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id,
        ));
    }

    public function del_data()
    {
        $query = 'DELETE FROM data WHERE id_usr=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id,
        ));
    }

    public function del_interest()
    {
        $query = 'DELETE FROM interest WHERE id_usr=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id,
        ));
    }

    public function addPP($pic)
    {
        $query = 'INSERT INTO `photo` (id_usr, pp) VALUE (:id, :pic)';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id,
            ":pic" => $pic
        ));
    }

    public function recup_popu_suggest(){
        $arr = [];
        $query = 'SELECT id_usr FROM data WHERE popularite>=5000 AND NOT id_usr=:id ORDER BY `popularite` DESC';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
           ":id" => $_SESSION['id']
        ));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($arr, $data);
        return $arr;
    }

    public function research_age($min, $max){
        $arr = [];
        $query = 'SELECT id_usr FROM data WHERE age>=:min AND age<=:max AND id_usr!=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":min" => $min,
            ":max" => $max,
//            ":id" => $_SESSION['id'],
            ":id" => $this->id,
        ));
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC))
            array_push($arr, $data);
        return $arr;
    }

    public function recup_pop($id){
        $query = 'SELECT popularite FROM data WHERE id_usr=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $id
        ));
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fetch['popularite'];
    }
}

class account
{
    private $login;
    private $nom;
    private $id;
    private $password;
    private $email;
    private $date;
    private $notif;
    private $db_con;
    private $valid;
    public $error;

    public function __construct(array $user_account)
    {
        if (array_key_exists('id', $user_account))
            $this->id = $user_account['id'];
        if (array_key_exists('login', $user_account))
            $this->login = $user_account['login'];
        if (array_key_exists('password', $user_account))
            $this->password = $user_account['password'];
        if (array_key_exists('email', $user_account))
            $this->email = $user_account['email'];
        if (array_key_exists('notif', $user_account))
            $this->notif = $user_account['notif'];
        if (array_key_exists('nom', $user_account))
            $this->nom = $user_account['nom'];
        if (array_key_exists('valid', $user_account))
            $this->valid = $user_account['valid'];
        $this->date = date('Y-m-d H:i:s');
        $this->db_con = database_connect();
    }

    // RECUP USER ARRAY

    public function array_user()
    {
        $query = 'SELECT * FROM user_db WHERE login=:log';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":log" => $this->login
        ));
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }

    public function array_user_id()
    {
        $query = 'SELECT * FROM user_db WHERE id=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id
        ));
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }

    // CONTROL INSCRIPTION LOGIN / EMAIL

    public function user_passwd()
    {
        $query = 'SELECT * FROM user_db WHERE login=:log';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":log" => $this->login
        ));
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fetch['password'];
    }

    public function ifLoginTaken()
    {
        $stmt = $this->db_con->prepare("SELECT * FROM user_db WHERE login=:login");
        $stmt->execute(array(
            ":login" => $this->login
        ));
        $count = $stmt->rowCount();
        if ($count != 0) {
            $_SESSION['error'] = 6;
            return 1;
        }
        return 0;
    }

    public function ifEmailTaken()
    {
        $stmt = $this->db_con->prepare("SELECT * FROM user_db WHERE email=:email");
        $stmt->execute(array(
            ":email" => $this->email
        ));
        $count = $stmt->rowCount();
        if ($count != 0) {
            if (!isset($_SESSION['modif'])) {
                $_SESSION['error'] = 7;
                header("Location: ../view/register.php");
            }
            return 1;
        }
        return 0;
    }

//              AJOUT USER

    public function add()
    {
        try {
            if ($this->ifLoginTaken() || $this->ifEmailTaken())
                return 1;
            $stmt = $this->db_con->prepare("INSERT INTO user_db(login, nom, email, password, creation_date) VALUES (:login, :nom, :email, :password, :creation_date)");
            $val = $stmt->execute(array(
                ":login" => $this->login,
                ":nom" => $this->nom,
                ":email" => $this->email,
                ":password" => $this->password,
                ":creation_date" => $this->date
            ));
            if ($val) {
                $_SESSION['loggued_but_not_valid'] = $this->login;
                return 0;
            } else
                echo "ERROR EXECUTE ADD";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

//    EDIT PROFIL

//    public function UpPass($user)
//    {
//        try {
//            $stmt = $this->db_con->prepare("UPDATE user_db SET password=:password WHERE login='$user'");
//            $val = $stmt->execute(array(
//                ":password" => $this->password,
//            ));
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//        $_SESSION['alert'] = 11;
//        return 1;
//    }
//
//    public function UpLogin($user)
//    {
//        try {
//            $stmt = $this->db_con->prepare("UPDATE user_db SET login=:login WHERE login='$user'");
//            $val = $stmt->execute(array(
//                ":login" => $this->login,
//            ));
//            $stmt = $this->db_con->prepare("UPDATE data SET login=:login WHERE login='$user'");
//            $val = $stmt->execute(array(
//                ":login" => $this->login,
//            ));
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//        $_SESSION['alert'] = 12;
//        return 1;
//    }
//
//    public function UpEmail($user)
//    {
//        try {
//            $stmt = $this->db_con->prepare("UPDATE user_db SET email=:email WHERE login='$user'");
//            $val = $stmt->execute(array(
//                ":email" => $this->email,
//            ));
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//        $_SESSION['alert'] = 13;
//        return 1;
//    }

    public function edit_profil($id)
    {
        try {
            $stmt = $this->db_con->prepare("UPDATE user_db SET login=:login, email=:email, password=:password, nom=:nom WHERE id='$id'");
            $stmt->execute(array(
                ":login" => $this->login,
                ":email" => $this->email,
                ":password" => $this->password,
                ":nom" => $this->nom
            ));
            unset($_SESSION['loggued_on_user']);
            $_SESSION['loggued_on_user'] = $this->login;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

//              EMAIL D'ACTIVATION

    public function sendMail()
    {
        $cle = md5(microtime(TRUE) * 100000);
        $stmt = $this->db_con->prepare("UPDATE user_db SET cle=:cle WHERE login=:login");
        $stmt->execute(array(
            ":cle" => $cle,
            ":login" => $this->login
        ));
        $sujet = "Matcha | Activer votre compte";
        $entete = "From: no_reply@matcha.com";
        $message = 'Bienvenue sur Matcha ' . $this->login . '!

		Pour activer votre compte, veuillez cliquer sur le lien ci dessous
		ou copier/coller dans votre navigateur internet.

		http://localhost:8008/models/activation.php?login=' . urlencode($this->login) . '&cle=' . urlencode($cle) . '
		---------------
		Ceci est un mail automatique, Merci de ne pas y répondre.';
        mail($this->email, $sujet, $message, $entete);
    }

    //              EMAIL RECOVERY PASS

    public function passMail($newpass)
    {

        $stmt = $this->db_con->prepare("UPDATE user_db SET password=:password WHERE login=:login");
        $stmt->execute(array(
            ":login" => $this->login,
            ":password" => $this->password
        ));
        $stmt = $this->db_con->prepare("SELECT email FROM user_db WHERE login=:login");
        $stmt->execute(array(
            ":login" => $this->login
        ));
        $fetched = $stmt->fetch(PDO::FETCH_ASSOC);
        $sujet = "Matcha | Réinitialisation de votre mot de passe";
        $entete = "From: no_reply@matcha.com";
        $message = 'Salut ' . $this->login . '!
        
        Voici ton nouveau mot de passe:    ' . $newpass . '
		---------------
		Ceci est un mail automatique, Merci de ne pas y répondre.';
        mail($fetched['email'], $sujet, $message, $entete);
    }


//              ACTIVATION

    public function Activation($cle, $login)
    {
        $stmt = $this->db_con->prepare("SELECT cle,valid FROM user_db WHERE login=:login");
        $stmt->execute(array(
            ":login" => $login
        ));
        $count = $stmt->rowcount();
        if ($count == 0)
            return 1;
        $fetched = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fetched['valid'])
            return 2;
        if ($fetched['cle'] == $cle) {
            $stmt = $this->db_con->prepare("UPDATE user_db SET valid=:valid WHERE login=:login");
            $stmt->execute(array(
                    ":valid" => true,
                    ":login" => $login)
            );
            $_SESSION['loggued_on_user'] = $login;
            return 0;
        }
        return 3;
    }

//              CONNEXION

    public function Connect()
    {
        $stmt = $this->db_con->prepare("SELECT email, valid, password, login, profile, id FROM user_db WHERE login=:login");
        $stmt->execute(array(
            ":login" => $this->login
        ));
        $count = $stmt->rowCount();
        if ($count == 0)
            return 1;
        $fetched = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fetched['valid'])
            return 2;
        if ($fetched['password'] !== $this->password)
            return 3;
        if ($fetched['profile'] == 0) {
            $_SESSION['loggued_on_user'] = $fetched['login'];
//            $_SESSION['loggued_but_not_complet'] = $fetched['login'];
            return 4;
        } else {
            $_SESSION['loggued_on_user'] = $fetched['login'];
            $_SESSION['id'] = $fetched['id'];
            return 0;
        }
    }

    public function set_statut($i)
    {
        echo 'ok';
        $query = 'UPDATE user_db SET statut=:i WHERE login=:log';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":log" => $this->login,
            ":i" => $i
        ));
    }

    public function UpNotif()
    {
        $stmt = $this->db_con->prepare("UPDATE user_db SET notif=:notif WHERE login=:login");
        $val = $stmt->execute(array(
            ":login" => $this->login,
            ":notif" => $this->notif
        ));
        if ($val)
            return 1;
        else
            return 0;
    }

    public function __destruct()
    {
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setValid()
    {
        $query = 'UPDATE user_db SET valid=1 WHERE login=:login';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":login" => $this->login
        ));
    }

    public function setProfile()
    {
        $query = 'UPDATE user_db SET profile=1 WHERE login=:login';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":login" => $this->login
        ));
    }

    public function select_id($id)
    {
        $query = 'SELECT id FROM user_db WHERE id=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $id
        ));
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($fetch['id']))
            return 1;
        return 0;
    }

    public function select_login($id)
    {
        $error_user = 'Compte supprimé';
        $query = 'SELECT login FROM user_db WHERE id=:id';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $id
        ));
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($fetch['login']))
            return $fetch['login'];
        else
            return $error_user;
    }
}

class history
{
    private $id_usr;
    private $id_usr_h;
    private $date;

    private $db_con;
    public $error;

    public function __construct(array $user_history)
    {
        if (array_key_exists('id_usr', $user_history))
            $this->id_usr = $user_history['id_usr'];
        if (array_key_exists('id_usr_h', $user_history))
            $this->id_usr_h = $user_history['id_usr_h'];
        $this->date = date('Y-m-d H:i:s');
        $this->db_con = database_connect();
    }

    public function add_history()
    {
        $query = 'INSERT INTO `visit` (id_usr, id_usr_h, date) VALUE (:id_usr, :id_usr_h, :date)';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id_usr" => $this->id_usr,
            ":id_usr_h" => $this->id_usr_h,
            ":date" => $this->date
        ));
    }

    public function get_history()
    {
        $query = 'SELECT id_usr, date FROM visit WHERE id_usr_h=:id ORDER BY id DESC';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id" => $this->id_usr_h
        ));
        $fetch = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $fetch[] = $data;
        }
        return $fetch;
    }
}

class like
{
    private $id_usr;
    private $id_usr_l;
    private $like_usr;
    private $like_usr_l;

    private $db_con;
    public $error;

    public function __construct(array $user_like)
    {
        if (array_key_exists('id_usr', $user_like))
            $this->id_usr = $user_like['id_usr'];
        if (array_key_exists('id_usr_l', $user_like))
            $this->id_usr_l = $user_like['id_usr_l'];
        if (array_key_exists('like_usr', $user_like))
            $this->like_usr = $user_like['like_usr'];
        if (array_key_exists('like_usr_l', $user_like))
            $this->like_usr_l = $user_like['like_usr_l'];
        $this->db_con = database_connect();
    }

    public function add_like(){
        $query= 'INSERT INTO `likes` (id_usr, id_usr_l) VALUE (:id_usr, :id_usr_l)';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id_usr" => $this->id_usr,
            ":id_usr_l" => $this->id_usr_l
        ));
        return 0;
    }

    public function if_like(){
        $query= 'SELECT id FROM likes WHERE id_usr=:id_usr AND id_usr_l=:id_usr_l';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id_usr" => $this->id_usr,
            ":id_usr_l" => $this->id_usr_l
        ));
        $al_like = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($al_like['id'])){
            return 1;
        }
        else
            return 0;
    }

    public function del_like(){
        $query= 'DELETE FROM `likes` WHERE id_usr=:id_usr AND id_usr_l=:id_usr_l';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id_usr" => $this->id_usr,
            ":id_usr_l" => $this->id_usr_l
        ));
        return 0;
    }



    /*public function add_like()
    {
        $query = 'SELECT id FROM likes WHERE id_usr=:id_usr_l AND id_usr_l=:id_usr AND like_usr=1';
        $stmt = $this->db_con->prepare($query);
        $stmt->execute(array(
            ":id_usr_l" => $this->id_usr_l,
            ":id_usr" => $this->id_usr
        ));
        $match = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($match['id'])) {
            $query_match = 'UPDATE likes SET like_usr_l=1 WHERE id=:id_m';
            $stmt = $this->db_con->prepare($query_match);
            $stmt->execute(array(
                ":id_m" => $match['id']
            ));
            return "match";
        }
        else if (!isset($match['id'])){
            $query = 'SELECT id FROM likes WHERE id_usr=:id_usr AND id_usr_l=:id_usr_l AND like_usr=1';
            $stmt = $this->db_con->prepare($query);
            $stmt->execute(array(
                ":id_usr_l" => $this->id_usr_l,
                ":id_usr" => $this->id_usr
            ));
            $al_like = $stmt->fetch(PDO::FETCH_ASSOC);
            if (isset($al_like['id'])) {
                $query_match = 'UPDATE likes SET like_usr=0 WHERE id=:id_m';
                $stmt = $this->db_con->prepare($query_match);
                $stmt->execute(array(
                    ":id_m" => $al_like['id']
                ));
                return "like delete1";
            }
            $query2 = 'SELECT id FROM likes WHERE id_usr=:id_usr_l AND id_usr_l=:id_usr AND like_usr_l=1';
            $stmt = $this->db_con->prepare($query2);
            $stmt->execute(array(
                ":id_usr_l" => $this->id_usr_l,
                ":id_usr" => $this->id_usr
            ));
            $al_like2 = $stmt->fetch(PDO::FETCH_ASSOC);
            if (isset($al_like2['id'])) {
                $query_match = 'UPDATE likes SET like_usr_l=0 WHERE id=:id_m';
                $stmt = $this->db_con->prepare($query_match);
                $stmt->execute(array(
                    ":id_m" => $al_like2['id']
                ));
                return "like delete2";
            }
            else if (!isset($al_like['id']) && !isset($al_like2['id'])){
                $query_create = 'INSERT INTO `likes` (id_usr, id_usr_l, like_usr) VALUE (:id_usr, :id_usr_l, :like_usr)';
                $stmt = $this->db_con->prepare($query_create);
                $stmt->execute(array(
                    ":id_usr" => $this->id_usr,
                    ":id_usr_l" => $this->id_usr_l,
                    ":like_usr" => '1'
                ));
                return "like";
            }
        }
        return "ok";
    }*/
}