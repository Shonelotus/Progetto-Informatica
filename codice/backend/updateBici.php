<?php
include_once("../gestioneDB/gestioneDatabase.php");
header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();

if(isset($_GET['id']) && isset($_GET['gps']) && isset($_GET['rfid']) && isset($_GET['latitude']) && isset($_GET['longitude'])) 
{
    $id = $_GET['id'];
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
    
    $result = $gest->updateBiciDB($id, $gps, $rfid, $latitude, $longitude);
    echo json_encode(["status" => $result['status'], "message" => $result['message']]);
} 
else 
{
    echo json_encode(["status" => false, "message" => "Errore nei dati della bici"]);
}
?>
