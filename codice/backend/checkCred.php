<?php
include_once("../gestioneDB/gestioneDatabase.php");

header('Content-Type: application/json');

$gest = new gestioneDatabase();
$gest->connettiDb();
$risposta = "";

if(isset($_POST["email"]) && isset($_POST["password"]) ) 
{
    $email = $_POST['email'];
    $password = $_POST['password']; 

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

        if($risposta === false)
        {
            session_destroy();
        }
        $gest->conn->close();
        echo json_encode(["status" => $risposta]);
    }
}

?>


