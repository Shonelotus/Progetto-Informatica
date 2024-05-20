<?php
include_once("../gestioneDB/gestioneDatabase.php");
header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();

if (isset($_POST['name']) && isset($_POST['lat']) && isset($_POST['long']) && isset($_POST['description']))
{
    $name = $_POST['name'];
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $description = $_POST['description'];
    $gest->addMarkerDB($name, $lat, $long, $description);

}
else
{
    echo json_encode(["status" => false, "message" => "Caricamento fallito"]);
}



?>
