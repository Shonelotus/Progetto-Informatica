<?php
include_once("../gestioneDB/gestioneDatabase.php");

header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();
$biciclette;
if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION["isAdmin"]))
{
    $biciclette = $gest->getBici();
    $gest->conn->close();
    echo json_encode(["biciclette" => $biciclette]);
}
else
    echo json_encode(["status" => false, "message" => "Non sei un admin"]);

?>


