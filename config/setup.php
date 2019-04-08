<head>
    <link rel="icon" type="image/png" href="../view/assets/images/favico.png"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<style>
    h1 {
        color: #333;
        font-size: 40px;
    }

    body {
        display: block;
        width: 100%;
        height: 100%;
        font-family: 'Nunito', sans-serif;
        font-size: 16px;
        line-height: 32px;
        color: #7d93b2;
        background-color: #fafcff;
        font-weight: 200;
        margin: 0;
    }

    .lg-title, .lg {
        float: left;
        padding: 10px;
        font-size: 60px;
        padding-bottom: 15px;
    }

    .lg-title {
        background-color: #ff5c72;
        color: white;
    }

    .error-sql{
        position: absolute;
        right: 0;
        left: 0;
        top: 500px;
        color: #820000;
    }

    .success-sql{
        position: absolute;
        right: 0;
        left: 0;
        top: 500px;
        color: #2da977;
    }

</style>

<div class="">
    <a href="../index.php" target="_self">
        <h1 class="lg-title">cama</h1>
        <h1 class="lg">gru.</h1>
    </a>
</div>

<div style="text-align: center !important;">
<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-06
 * Time: 14:28
 */

require_once("database.php");
try {
    $db = database_connect();
    $sql_create_data_tbl = <<<EOSQL
CREATE TABLE data (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_usr int(11) NOT NULL,
  age int(3) NOT NULL,
  sex int(1) NOT NULL,
  location varchar(255) NOT NULL,
  orientation int(1) NOT NULL,
  bio varchar(255) NOT NULL,
  popularite int(11) NOT NULL default '0',
  PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci
EOSQL;

    $sql_create_user_db_tbl = <<<EOSQL
CREATE TABLE user_db (
  id int(11) NOT NULL AUTO_INCREMENT,
  login varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  nom varchar(50) NOT NULL,
  password binary(64) NOT NULL COMMENT 'sha-256',
  email varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  creation_date date DEFAULT NULL,
  cle varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  notif tinyint(1) DEFAULT NULL,
  valid tinyint(1) DEFAULT NULL,
  statut varchar(255) NOT NULL default '0',
  profile binary(1) NOT NULL default '0',
  PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci
EOSQL;

    $sql_create_likes_tbl = <<<EOSQL
CREATE TABLE likes (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_usr int(11) NOT NULL,
  id_usr_l int(11) NOT NULL,
  PRIMARY KEY (id)
)ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci
EOSQL;

    $sql_create_picture_tbl = <<<EOSQL
CREATE TABLE photo (
  id int (11) NOT NULL AUTO_INCREMENT,
  id_usr int(11) NOT NULL,
  photo VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci
EOSQL;

    $sql_create_block_tbl = <<<EOSQL
CREATE TABLE block (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_usr int(11) NOT NULL,
  id_usr_b int(11) NOT NULL,
  PRIMARY KEY (id)
)ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci
EOSQL;

    $sql_create_report_tbl = <<<EOSQL
CREATE TABLE report (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_usr int(11) NOT NULL,
  id_usr_r int (11) NOT NULL,
  PRIMARY KEY (id)
)ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci
EOSQL;

    $sql_create_interest_tbl = <<<EOSQL
CREATE TABLE interest (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_usr int(11) NOT NULL,
  sport binary(1) NOT NULL default '0',
  voyage binary(1) NOT NULL default '0',
  vegan binary(1) NOT NULL default '0',
  geek binary(1) NOT NULL default '0',
  soiree binary(1) NOT NULL default '0',
  tattoo binary(1) NOT NULL default '0',
  musique binary(1) NOT NULL default '0',
  lecture binary(1) NOT NULL default '0',
  association binary(1) NOT NULL default '0',
  theatre binary(1) NOT NULL default '0',
  religion binary(1) NOT NULL default '0',
  PRIMARY KEY (id)
)ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci
EOSQL;

    $sql_create_visit_tbl = <<<EOSQL
CREATE TABLE visit (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_usr int(11) NOT NULL,
  id_usr_h int(11) NOT NULL,
  date date DEFAULT NULL,
  PRIMARY KEY (id)
)ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE=utf8_unicode_ci
EOSQL;

    $sql_create_user = <<<EOSQL
INSERT INTO user_db (login, password, email, valid, profile)
VALUES 
  ('root', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 'pmaglioz@gmail.com', '1', '1');
EOSQL;

    $msg = '';
    $msg_err = '';

    $r = $db->exec($sql_create_data_tbl);

    if ($r !== false) {

        $r = $db->exec($sql_create_user_db_tbl);
        $r = $db->exec($sql_create_user);
        $r = $db->exec($sql_create_likes_tbl);
        $r = $db->exec($sql_create_picture_tbl);
        $r = $db->exec($sql_create_block_tbl);
        $r = $db->exec($sql_create_report_tbl);
        $r = $db->exec($sql_create_interest_tbl);
        $r = $db->exec($sql_create_visit_tbl);

        if ($r !== false) {
            $msg = "Tables are created successfully!." . "<br>";
        } else {
            $msg_err = "Error creating table." . "<br>";
        }

    } else {
        $msg_err = "Error creating table." . "<br>";
    }

    // display the message
    if ($msg != '') {
        echo "<h2 class='success-sql'>$msg<br><i class=\"far fa-smile-beam fa-9x\"></i></h2>" . "\n";
        $delai=2;
        $url='../index.php';
        header("Refresh: $delai;url=$url");
    }
    else if ($msg_err != '')
        echo "<h2 class='error-sql'>$msg_err<br><i class=\"far fa-sad-cry fa-9x\"></i></h2>" . "\n";

} catch (PDOException $e) {
    $msg2 = $e->getMessage();
    echo "<br>" . "<h2 class='error-sql' >$msg2<br><i class=\"far fa-sad-cry fa-7x\"></i></h2>";
}
?>
</div>
