<?php
session_start();
header('Content-Type: application/json');


if(!isset($_SESSION))
{
    session_start();
}

if(isset($_SESSION["isAdmin"]))
{
    if(isset($_GET['id'])) 
    {
        $_SESSION['idBici'] = $_GET['id'];
        echo json_encode(["status" => true]);
    } 
    else 
    {
        echo json_encode(["status" => false, "message" => "ID non inviato"]);
    }
}
else 
{
    echo json_encode(["status" => false, "message" => "Errore del server"]);
}
?>