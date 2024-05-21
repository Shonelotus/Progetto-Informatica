<?php
include_once("../gestioneDB/gestioneDatabase.php");

$gest = new gestioneDatabase();
$gest->connettiDb();

header('Content-Type: application/json');
$markers = $gest->getMarkers();
echo json_encode($markers);
?>
