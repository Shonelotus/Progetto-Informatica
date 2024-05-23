<?php
session_start();
header('Content-Type: application/json');

if(isset($_GET['id'])) 
{
    $_SESSION['idStazione'] = $_GET['id'];
    echo json_encode(["status" => true]);
} 
else 
{
    echo json_encode(["status" => false, "message" => "ID non inviato"]);
}
?>