<?php
include_once("../gestioneDB/gestioneDatabase.php");

header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();
$id = $_GET['id'];

$risposta = false;

$risposta = $gest->deleteBici($id);

$gest->conn->close();
echo json_encode(["status" => $risposta]);

?>


