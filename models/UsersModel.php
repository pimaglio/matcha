<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-06
 * Time: 17:50
 */

include('../config/database.php');
session_start();

class account
{
    private $login;
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
        $this->date = date('Y-m-d H:i:s');
        $this->db_con = database_connect();
    }

//              CONTROL INSCRIPTION LOGIN / EMAIL

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
            $stmt = $this->db_con->prepare("INSERT INTO user_db(login,email,password,creation_date) VALUES (:login, :email, :password, :creation_date)");
            $val = $stmt->execute(array(
                ":login" => $this->login,
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
            $stmt = $this->db_con->prepare("UPDATE user_db SET login=:login, email=:email, password=:password WHERE login='$usser'");
            $val = $stmt->execute(array(
                ":login" => $this->login,
                ":email" => $this->email,
                ":password" => $this->password,
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
        $sujet = "Camagru | Activer votre compte";
        $entete = "From: no_reply@camagru.com";
        $message = 'Bienvenue sur Camagru ' . $this->login . '!

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
        $sujet = "Camagru | Réinitialisation de votre mot de passe";
        $entete = "From: no_reply@camagru.com";
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
