<?php
include_once("../gestioneDB/gestioneDatabase.php");

header('Content-Type: application/json');
if(!isset($_SESSION))
{
    session_start();
}
if(isset($_SESSION["isAdmin"]))
{
    $gest = new gestioneDatabase();
    $gest->connettiDb();
    $id = $_GET['id'];

    $risposta = false;

    $risposta = $gest->deleteBici($id);

    $gest->conn->close();
    echo json_encode(["status" => $risposta]);
}
else
    echo json_encode(["status" => false, "message" => "Non sei un admin"]);


?>


