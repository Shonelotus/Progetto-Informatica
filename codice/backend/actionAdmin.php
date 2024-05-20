<?php
include_once("../gestioneDB/gestioneDatabase.php");

if(!isset($_SESSION)) 
{       
    session_start();
}

header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();
$risposta = "";

if(isset($_GET["scelta"]) && isset($_GET["azione"]) ) 
{
    $scelta = $_GET['scelta'];
    $azione = $_GET['azione'];
    
    if($scelta == "Bicicletta")
    {
        if($azione = "Aggiungi")
        {
            //aggiungo lo slot

        }
        else if($azione = "Rimuovi")
        {
            //rimuovo lo slot
        }
        else 
        {
            //modifico la bici
        }
    }
    else if($scelta == "Slot")
    {
        if($azione = "Aggiungi")
        {
            //aggiungo lo slot

        }
        else if($azione = "Rimuovi")
        {
            //rimuovo lo slot
        }
        else 
        {
            return false;
        }
    }
    else
    {
        if($azione = "Aggiungi")
        {
            //aggiungo la stazione

        }
        else if($azione = "Rimuovi")
        {
            //rimuovo la stazione
        }
        else 
        {
            //modifico la stazione
        }
    }

    $gest->conn->close();
    echo json_encode(["status" => $risposta]);
}
?>


