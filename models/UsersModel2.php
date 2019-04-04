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
//        if (isset($_SESSION['loggued_on_user']))
//            $this->login = $_SESSION['loggued_on_user'];
        if (isset($_POST['login']))
            $this->login = $_POST['login'];
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
            $query = 'UPDATE `interest` SET ' . $k . '=1 WHERE id_usr=:id';
            $stmt = $this->db_con->prepare($query);
            $stmt->execute(array(
                ":id" => $this->id
            ));
        }
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
}

class account
{
    private $login;
    private $nom;
    private $password;
    private $email;
    private $date;
    private $notif;
    private $db_con;
    public $error;

    public function __construct(array $user_account)
    {
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
        $this->date = date('Y-m-d H:i:s');
        $this->db_con = database_connect();
    }

//              CONTROL INSCRIPTION LOGIN / EMAIL

    public function user_passwd(){
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
            $_SESSION['error'] = 2;
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
            $_SESSION['error'] = 6;
            header("Location: ../view/register.php");
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

    public function UpPass($user)
    {
        try {
            $stmt = $this->db_con->prepare("UPDATE user_db SET password=:password WHERE login='$user'");
            $val = $stmt->execute(array(
                ":password" => $this->password,
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $_SESSION['alert'] = 11;
        return 1;
    }

    public function UpLogin($user)
    {
        try {
            $stmt = $this->db_con->prepare("UPDATE user_db SET login=:login WHERE login='$user'");
            $val = $stmt->execute(array(
                ":login" => $this->login,
            ));
            $stmt = $this->db_con->prepare("UPDATE data SET login=:login WHERE login='$user'");
            $val = $stmt->execute(array(
                ":login" => $this->login,
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $_SESSION['alert'] = 12;
        return 1;
    }

    public function UpEmail($user)
    {
        try {
            $stmt = $this->db_con->prepare("UPDATE user_db SET email=:email WHERE login='$user'");
            $val = $stmt->execute(array(
                ":email" => $this->email,
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $_SESSION['alert'] = 13;
        return 1;
    }

    public function edit_profil($usser)
    {
        try {
            if ($this->ifLoginTaken() || $this->ifEmailTaken())
                return 1;
            $stmt = $this->db_con->prepare("UPDATE user_db SET login=:login, nom=:nom, email=:email, password=:password WHERE login='$usser'");
            $val = $stmt->execute(array(
                ":login" => $this->login,
                ":email" => $this->email,
                ":password" => $this->password,
                ":nom" => $this->nom
            ));
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
        $stmt = $this->db_con->prepare("SELECT email, valid, password, login FROM user_db WHERE login=:login");
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
        $_SESSION['loggued_on_user'] = $fetched['login'];
        return 0;
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
}