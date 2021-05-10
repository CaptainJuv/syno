<?php

require("model/ops/cis.php");
require("model/ops/intervention.php");
require("model/ops/engin.php");
require("model/ops/personnel.php");
//require("model/globales.php");


////////////////////////////////////////////////////////
//          CONTROLLEUR DE L'AFFICHAGE DU SYNO
////////////////////////////////////////////////////////

function GetRunnigInters()
{
    $req = "";
    $serv = SQL_SERVER;
    $database = SQL_DB;
    $user = SQL_UID;
    $password = SQL_PWD;

    $litv[] = new intervention;
    $itv = new intervention;

    $connection = odbc_connect("Driver={SQL Server};Server=$serv;Database=$database;", $user, $password)
        or die("Echec connection à la base de données $serv");

    if ($connection) {
        $results = odbc_exec($connection, "select * from CRSS_interventions");

        if ($results) {
            echo ("REQUETE OK");

            while (odbc_fetch_row($results)) {

                $itv->ItvRef = odbc_result($results, "idIntervention");
                $itv->Num = odbc_result($results, "NumArtemis");
                $itv->TypeItv = odbc_result($results, "typItvCod");
                $itv->Sinistre = odbc_result($results, "Sinistre");
                $itv->Adresse = odbc_result($results, "Adresse");
                $itv->Ville = odbc_result($results, "Ville");
                $itv->Observations = odbc_result($results, "Observations");
                $itv->Groupement = odbc_result($results, "Groupement");
                $d1 = date_create(odbc_result($results, "HeureArrivee"));
                $itv->DateDeb = date_create(odbc_result($results, "HeureArrivee"));
                $itv->Carre = odbc_result($results, "Carre");
                $itv->X_WGS84 = odbc_result($results, "X_WGS84");
                $itv->Y_WGS84 = odbc_result($results, "Y_WGS84");
                $itv->codInsee = odbc_result($results, "codInsee");
            }
            return $itv;

        } else
        {
            
            echo ("REQUETE NOK");
            return null;
        }
            
    }
}
