<?php


class user{
    public string $login;
    public string $password;
    public string $datcrea;

    public string $Nom;
    public string $Prenom;
    public string $Grade;

    public $Profils;


    // authentifie l'utilisateur sur l'AD
    public function AuthUser(string $ldap)
    {
        $ldapconn = ldap_connect($ldap)
            or die("Impossible de se connecter à " . $ldap);


        if ($ldapconn) {
            $ldapbind = ldap_bind($ldapconn, $this->login, $this->password);

            // Vérification de l'authentification
            if ($ldapbind) {
                echo "Connexion LDAP réussie...";
                return true;
            } else {
                echo "Connexion LDAP échouée...";
                return false;
            }
        }
    }





}