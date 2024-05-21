<?php
include_once("../gestioneDB/gestioneDatabase.php");
header('Content-Type: application/json');

if (!isset($_SESSION)) {
    session_start();
}

$gest = new gestioneDatabase();
$gest->connettiDb();
$risposta = "";

if (isset($_POST["nome"], $_POST["cognome"], $_POST["email"], $_POST["password"], $_POST["numeroTessera"], $_POST["numeroCartaCredito"], $_POST["stato"], $_POST["provincia"], $_POST["paese"], $_POST["cap"], $_POST["via"])) 
{
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $numeroTessera = $_POST['numeroTessera'];
    $numeroCartaCredito = $_POST['numeroCartaCredito'];
    $stato = $_POST['stato'];
    $provincia = $_POST['provincia'];
    $paese = $_POST['paese'];
    $cap = $_POST['cap'];
    $via = $_POST['via'];

    //controllo che siano inseriti e non campi vuoit
    if (empty($nome) || empty($cognome) || empty($email) || empty($password) || empty($numeroTessera) || empty($numeroCartaCredito) || empty($stato) || empty($provincia) || empty($paese) || empty($cap) || empty($via)) 
    {
        $risposta = false;
        echo json_encode(["status" => $risposta]);
        exit;
    }

    //il nome può essere solo lettere o spazi
    if (!preg_match("/^[a-zA-Z ]+$/", $nome) || !preg_match("/^[a-zA-Z ]+$/", $cognome)) 
    {
        $risposta = false;
        echo json_encode(["status" => $risposta]);
        exit;
    }

    //controllo che la email sia valida
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $risposta = false;
        echo json_encode(["status" => $risposta]);
        exit;
    }

    //la password deve essere almeno di 8 caratteri
    if (strlen($password) < 8) 
    {
        $risposta = false;
        echo json_encode(["status" => $risposta]);
        exit;
    }


    /**
     * ATTENZIONE
     * LA TESSERA DEVE ESSERE UNIVOCA
     */


    //la tessere almeno di 6
    if (!preg_match("/^\d{6}$/", $numeroTessera)) 
    {
        $risposta = false;
        echo json_encode(["status" => $risposta]);
        exit;
    }

    //la carta di credito deve essere obbligatoriamente di 16 caratteri
    if (!preg_match("/^\d{16}$/", $numeroCartaCredito)) 
    {
        $risposta = false;
        echo json_encode(["status" => $risposta]);
        exit;
    }

    //il cap deve essere di 5 caratteri
    if (!preg_match("/^\d{5}$/", $cap)) 
    {
        $risposta = false;
        echo json_encode(["status" => $risposta]);
        exit;
    }

    $risposta = $gest->aggiungiUtente($nome, $cognome, $email, $password, $numeroTessera, $numeroCartaCredito, $stato, $provincia, $paese, $cap, $via);
    $id = $gest->takeId($email, $password);
    $_SESSION["id"] = $id;
    $_SESSION["admin"] = false;
} 
else 
{
    $risposta = false;
}

$gest->conn->close();
echo json_encode(["status" => $risposta]);
?>
