<?php
include_once("../gestioneDB/gestioneDatabase.php");

header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();
$risposta = "";

if(isset($_GET["email"]) && isset($_GET["password"]) ) 
{
    $email = $_GET['email'];
    $password = $_GET['password']; 

    //controllo che sia un admin
    $rispostaAdmin = $gest->checkAdmin($email, $password);
    if($rispostaAdmin === true)
    {
        $rispostaAdmin = "admin";
        $id = $gest->takeIdAdmin($email, $password);
        $_SESSION["id"] = $id;
        $_SESSION["admin"] = true;
        $gest->conn->close();
        echo json_encode(["status" => $rispostaAdmin]);    
    }
    //se non lo è allora controllo semplicemente se esiste
    else if($rispostaAdmin === false)
    {
        $risposta = $gest->controlloCredenziali($email, $password);
        $id = $gest->takeId($email, $password);
        $_SESSION["id"] = $id;
        $_SESSION["admin"] = false;
        $gest->conn->close();
        echo json_encode(["status" => $risposta]);
    }
}

?>


