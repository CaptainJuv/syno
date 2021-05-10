<?php
// controlleur
require("model/globales.php");
require("model/user.php");

////////////////////////////////////////
// AUTHENTIFIATION DES UTILISATEURS
////////////////////////////////////////
function AuthUser()
{
    $muser = new user();

    if (strlen($_POST["form_login"]) != 0 & strlen($_POST["form_password"]) != 0) {
        $muser->login = 'sdis77\\' . $_POST["form_login"];
        $muser->password = $_POST["form_password"];

        // Phase 1 : authentification AD
        if($muser->AuthUser(LDAP_SERVER1) == true)
        {
            // Authentification OK : On charge les informatios de l'utilisateur


            GetRunnigInters();
            require("view/mainPageView.php");
        }
        else
        {
            echo('byebye');

        }
    }
}

////////////////////////////////////////
// Affiche la vue login
////////////////////////////////////////
function DisplayLogin()
{
    require("view/LoginView.php");
}



////////////////////////////////////////
// OBTENTION DES DONNEES OPERATIONNELLES
////////////////////////////////////////








function DisplayUsers()
{

    // Va charger en la liste des utilisateurs
    $users = GetUserList();

    // selectionne la vue à afficher
    require("view/usersView.php");
}





// Naviguer vers la mainpage
function GoToMainPage()
{
    // On a déjà un utilisateur authentifié
    if (isset($_SESSION['authuser'])) {
        require("view/mainPageView.php");
    }
    // Sinon on demande une authentification
    else {
        DisplayLogin();
    }
}
