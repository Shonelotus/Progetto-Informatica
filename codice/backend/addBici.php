<?php
include_once("../gestioneDB/gestioneDatabase.php");
header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();

if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION["isAdmin"]))
{
    try {

        if (isset($_GET['gps']) && isset($_GET['rfid']) && isset($_GET['latitude']) && isset($_GET['longitude'])) 
        {
            $gps = $_GET['gps'];
            $rfid = $_GET['rfid'];
            $latitude = $_GET['latitude'];
            $longitude = $_GET['longitude'];
    
            // se il codice è maggiore o minore di 5 non va bene 
            // deve essere univoca
            if (!preg_match("/^\d{5}$/", $gps)) {
                echo json_encode(["status" => false, "message" => "Il codice gps non va bene"]);
                exit;
            }
    
            // se il codice è maggiore o minore di 4 non va bene 
            // deve essere univoca
            if (!preg_match("/^\d{4}$/", $rfid)) {
                echo json_encode(["status" => false, "message" => "Il codice RFID non va bene"]);
                exit;
            }
    
            //controllo che i dati siano univoci
            if($gest->uniqueDataBiciDb($gps, $rfid))
            {
                if ($gest->addBiciDB($gps, $rfid, $latitude, $longitude)) 
                {
                    echo json_encode(["status" => true, "message" => "Bici aggiunta con successo!"]);
                } else 
                {
                    echo json_encode(["status" => false, "message" => "Errore durante l'aggiunta della bici."]);
                }
            }
            else
            {
                echo json_encode(["status" => false, "message" => "Errore durante l'aggiunta della bici."]);
            }
        } 
        else 
        {
            echo json_encode(["status" => false, "message" => "Errore nei dati della bici"]);
        }
    } catch (Exception $e) {
        echo json_encode(["status" => false, "message" => "Errore del server: " . $e->getMessage()]);
    }
}
else
    echo json_encode(["status" => false, "message" => "Non sei un admin"]);



?>
