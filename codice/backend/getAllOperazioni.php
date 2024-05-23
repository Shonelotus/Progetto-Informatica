<?php
include_once("../gestioneDB/gestioneDatabase.php");

header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();
$stazioni;
if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION["isCliente"]))
{
    $id = $_SESSION["id"];
    $operazioni = $gest->getOperazioniDB($id);
    $gest->conn->close();
    echo json_encode(["operazioni" => $operazioni]);
}
else
    echo json_encode(["status" => false, "message" => "Non sei un cliente"]);

?>


