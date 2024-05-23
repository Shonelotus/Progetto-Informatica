<?php
header('Content-Type: application/json');

$host = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "noleggio";

if (!isset($_GET["idCliente"], $_GET["idBici"], $_GET["idStazione"], $_GET["tipoOperazione"], $_GET["distanza"])) 
{
    $arr = array("status" => false, "message" => "Parametri mancanti");
    echo json_encode($arr);
    exit;
}

// Connessione al database
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) 
{
    throw new Exception("Connection failed: " . $conn->connect_error);
}

/*
	id Primaria	int(11)			
	2	tipoOreazione	varchar(32)			
	3	dataOra	datetime			
	4	distanzaPercorsa	decimal(10,0)			
	5	tariffa	int(11)			
	6	idCliente Indice	int(11)				
	7	idBici Indice	int(11)			
	8	idStazione  Indice	int(11)
*/

$idUtente = $_GET["idCliente"];
$idBici = $_GET["idBici"];
$idStazione = $_GET["idStazione"];
$tipoOperazione = $_GET["tipoOperazione"];
$distanza = $_GET["distanza"];
$tariffa = floatval($distanza) * 0.80;
$dataOra = date('Y-m-d H:i:s');

$sql = "INSERT INTO `operazione`(`tipoOperazione`, `dataOra`, `distanzaPercorsa`, `tariffa`, `idCliente`, `idBici`, `idStazione`) VALUES (?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);

// Nota: Il numero di parametri in bind_param deve corrispondere al numero di placeholder nella query
$stmt->bind_param("sddiiii", $tipoOperazione, $dataOra, $distanza, $tariffa, $idUtente, $idBici, $idStazione);

if ($stmt->execute())
{
    $arr = array("status" => true, "message" => "Operazione aggiunta");
    echo json_encode($arr);
} else {
    $arr = array("status" => false, "message" => "Errore nell'esecuzione");
    echo json_encode($arr);
}
?>
