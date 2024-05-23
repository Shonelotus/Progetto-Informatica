<?php
include_once("../gestioneDB/gestioneDatabase.php");

header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();

if(isset($_GET['id'])) 
{
    $id = $_GET['id'];
    $stazione = $gest->getStazioneByIdDB($id);
    $gest->conn->close();

    if ($stazione) 
    {
        echo json_encode(["status" => true, "stazione" => $stazione]);
    } 
    else 
    {
        echo json_encode(["status" => false, "message" => "Stazione non trovata"]);
    }
} 
else 
{
    echo json_encode(["status" => false, "message" => "Errore del server"]);
}
?>