<?php
include_once("../gestioneDB/gestioneDatabase.php");
header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();

try 
{

    $input = json_decode(file_get_contents('php://input'), true);
    if(isset($input['id'])) 
    {
        $id = $input['id'];
        if($gest->deleteStazione($id)) 
        {
            echo json_encode(["status" => true, "message" => "Marker eliminato con successo!"]);
        } 
        else 
        {
            echo json_encode(["status" => false, "message" => "Errore durante l'eliminazione del marker."]);
        }
    } 
    else 
    {
        echo json_encode(["status" => false, "message" => "Dati mancanti per l'eliminazione"]);
    }
}
catch (Exception $e) 
{
    echo json_encode(["status" => false, "message" => "Errore del server: " . $e->getMessage()]);
}
?>
