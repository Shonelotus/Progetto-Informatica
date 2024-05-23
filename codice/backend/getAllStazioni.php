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


if(isset($_SESSION["isAdmin"]))
{
    $stazioni = $gest->getStazioniDB();
    $gest->conn->close();
    echo json_encode(["stazioni" => $stazioni]);
}
else
    echo json_encode(["status" => false, "message" => "Non sei un admin"]);

?>


