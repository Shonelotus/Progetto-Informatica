<?php
include_once("../gestioneDB/gestioneDatabase.php");

header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();
$stazioni;

$stazioni = $gest->getStazioniDB();
$gest->conn->close();
echo json_encode(["stazioni" => $stazioni]);

?>


