<?php
include_once("../gestioneDB/gestioneDatabase.php");
header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();

if(isset($_GET['id']) && isset($_GET['nome']) && isset($_GET['codice']) && isset($_GET['numeroSlot']) && isset($_GET['latitude']) && isset($_GET['longitude'])) 
{
    $id = $_GET['id'];
    $nome = $_GET['nome'];
    $codice = $_GET['codice'];
    $numeroSlot = $_GET['numeroSlot'];
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];

    // se il codice è maggiore o minore di 5 non va bene 
    // deve essere univoca
    if (!preg_match("/^\d{6}$/", $codice)) {
        echo json_encode(["status" => false, "message" => "Il codice non va bene"]);
        exit;
    }

    $result = $gest->updateStazioneDB($id, $nome, $codice, $numeroSlot, $latitude, $longitude);
    echo json_encode(["status" => $result['status'], "message" => $result['message']]);

} 
else 
{
    echo json_encode(["status" => false, "message" => "Errore nei dati della bici"]);
}
?>
