<?php
session_start();
require("model/cnxDB.php");
require("model/user.php");

//////////////////////////////////////////////
// Gestion de l'Authentification
//////////////////////////////////////////////
function Authentification($login, $password)
{
    if ($password == 'toto') {
        $_SESSION['login'] = $login;
    }
}

//////////////////////////////////////////////
// récupération de tous les utilisateurs
//////////////////////////////////////////////
function GetUserList()
{
    try {
        $db = new PDO(CnxString, DB_USERNAME, DB_PASSWORD);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    //$req = $db->prepare('SELECT * FROM users');
    //$req->execute();
    $liste_users = array();

    $req = $db->query('SELECT * FROM users');

    while ($d = $req->fetch()) {
        $mUser = new user();
        $mUser->login = $d['Login'];
        $mUser->password = $d['Password'];
        $mUser->datcrea = $d['DateCrea'];

        $liste_users[] = $mUser;
    }


    return $liste_users;
}
