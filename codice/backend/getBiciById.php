<?php
include_once("../gestioneDB/gestioneDatabase.php");

header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();

if(isset($_GET['id'])) 
{
    $id = $_GET['id'];
    $bicicletta = $gest->getBiciByIdDB($id);
    $gest->conn->close();

    if ($bicicletta) 
    {
        echo json_encode(["status" => true, "bicicletta" => $bicicletta]);
    } 
    else 
    {
        echo json_encode(["status" => false, "message" => "Bicicletta non trovata"]);
    }
} 
else 
{
    echo json_encode(["status" => false, "message" => "Errore del server"]);
}
?>