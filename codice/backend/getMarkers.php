<?php
include_once("../gestioneDB/gestioneDatabase.php");

$gest = new gestioneDatabase();
$gest->connettiDb();

header('Content-Type: application/json');
if (isset($_POST['name']) && isset($_POST['lat']) && isset($_POST['long']) && isset($_POST['description']))
{

    $markers = $gest->getMarkers();
    echo json_encode($markers);
}
else
{
    echo json_encode(["status" => false, "message" => "Caricamento fallito"]);
}



?>
