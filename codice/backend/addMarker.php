<?php
include_once("../gestioneDB/gestioneDatabase.php");
header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();

try {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['name']) && isset($input['codice']) && isset($input['numSlot']) && isset($input['lat']) && isset($input['long'])) 
    {
        $name = $input['name'];
        $codice = $input['codice'];
        $numslot = $input['numSlot'];
        $lat = $input['lat'];
        $long = $input['long'];

        // se il codice è maggiore o minore di 6 non va bene 
        // deve essere univoca
        if (!preg_match("/^\d{6}$/", $codice)) {
            echo json_encode(["status" => false, "message" => "Il codice non va bene"]);
            exit;
        }

        // se il numero degli slot è maggiore di 100 o minore di 0 non va
        if ($numslot < 0 || $numslot > 100) {
            echo json_encode(["status" => false, "message" => "Il numero degli slot non va bene"]);
            exit;
        }

        if ($gest->addStazione($name, $codice, $numslot, $lat, $long)) {
            echo json_encode(["status" => true, "message" => "Marker aggiunto con successo!"]);
        } else {
            echo json_encode(["status" => false, "message" => "Errore durante l'aggiunta del marker."]);
        }
    } else {
        echo json_encode(["status" => false, "message" => "Caricamento fallito"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => "Errore del server: " . $e->getMessage()]);
}
?>
