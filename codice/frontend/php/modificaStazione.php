<?php
if(!isset($_SESSION))
{
    session_start();
}

if(!isset($_SESSION["isAdmin"]))
{
    header('Location: index.php');
}

if (!isset($_SESSION['idStazione'])) {
    die("l'ID della stazione non è impostato nella sessione");
}
$idStazione = $_SESSION['idStazione'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Stazione</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(90deg, rgba(0,123,255,1) 0%, rgba(40,167,69,1) 100%);
            color: #fff;
            overflow: hidden; /* Hide scroll bars */
        }
        .container {
            max-width: 900px; /* Set a maximum width to the container */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border: none; /* Remove border */
            border-radius: 15px; /* Add border-radius */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add box-shadow */
        }
        .card-title {
            font-size: 1.5rem; /* Adjust title font size */
            font-weight: bold; /* Add font-weight */
            color: #007bff; /* Change title color */
        }
        .form-group label {
            color: #007bff; /* Change label color */
        }
        .form-control {
            border-radius: 30px; /* Add border-radius to form inputs */
        }
        .btn-primary, .btn-secondary {
            width: 100%; /* Make buttons full width */
            border-radius: 30px; /* Add border-radius */
            font-weight: bold; /* Add font-weight */
            margin-top: 10px; /* Add top margin */
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>

        var idStazione = <?php echo json_encode($idStazione); ?>;


        $(document).ready(function() 
        {
            if(idStazione) 
            {
                $.get("../../backend/getStazioneById.php", { id: idStazione}, function(data) {
                    if (data.status) {
                        const stazione = data.stazione;
                        $('#nome').val(stazione.nome);
                        $('#codice').val(stazione.codice);
                        $('#numeroSlot').val(stazione.numeroSlot);
                        $('#latitude').val(stazione.latitude);
                        $('#longitude').val(stazione.longitude);
                    } else {
                        alert("Errore nel recupero dei dati della stazione.");
                    }
                });
            }

            $("#modifica").click(function() {
                modifica();
            });

            $("#tornaIndietro").click(function() {
                window.location = "gestioneStazioni.php";
            });
        });

        function modifica()
        {
            var nome = $('#nome').val().trim();
            var codice = $('#codice').val().trim();
            var numeroSlot = $('#numeroSlot').val().trim();
            var latitude = $('#latitude').val().trim();
            var longitude = $('#longitude').val().trim();

            if (!nome || !codice || !numeroSlot || !latitude || !longitude) 
            {
                alert("Tutti i campi sono obbligatori");
                return false;
            }

            if (!/^\d{6}$/.test(codice)) 
            {
                alert("Il codice deve essere di 6 cifre");
                return false;
            }

            if(numeroSlot < 0 && numeroSlot > 100) 
            {
                alert("Il numero degli slot deve essere compreso tra 0 e 100");
                return false;
            }

            var dati = {
                id: idStazione,
                nome: nome,
                codice: codice,
                numeroSlot: numeroSlot,
                latitude: latitude,
                longitude: longitude
            };

            $.get("../../backend/updateStazione.php", dati)
                .done(function(data) 
                {
                    alert(data.message);
                })

        }


        function printResponse(data) 
        {
            alert(data["message"]);
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Modifica la stazione</h2>
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome">
                            </div>
                            <div class="form-group">
                                <label for="codice">Codice </label>
                                <input type="number" class="form-control" id="codice">
                            </div>
                            <div class="form-group">
                                <label for="numeroSlot">Numero degli slot</label>
                                <input type="number" class="form-control" id="numeroSlot">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitudine</label>
                                <input type="text" class="form-control" id="latitude">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitudine</label>
                                <input type="text" class="form-control" id="longitude">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="modifica">Modifica</button>
                    <button type="button" class="btn btn-secondary" id="tornaIndietro">Torna alla gestione stazioni</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
