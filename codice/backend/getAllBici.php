<?php
include_once("../gestioneDB/gestioneDatabase.php");

header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();
$biciclette;

$biciclette = $gest->getBici();
$gest->conn->close();
echo json_encode(["biciclette" => $biciclette]);

?>


