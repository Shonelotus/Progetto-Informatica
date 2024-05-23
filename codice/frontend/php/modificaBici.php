<?php
if(!isset($_SESSION))
{
    session_start();
}

if(!isset($_SESSION["isAdmin"]))
{
    header('Location: index.php');
}

if (!isset($_SESSION['idBici'])) 
{
    die("l'ID della bicicletta non è impostato nella sessione");
}
$idBici = $_SESSION['idBici'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica bicicletta</title>
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

        var idBici = <?php echo json_encode($idBici); ?>;
        $(document).ready(function() {
            if (idBici) {
                $.get("../../backend/getBiciById.php", { id: idBici }, function(data) {
                    if (data.status) {
                        const bici = data.bicicletta;
                        $('#gps').val(bici.gps);
                        $('#rfid').val(bici.codiceRFID);
                        $('#latitude').val(bici.latitude);
                        $('#longitude').val(bici.longitude);
                    } else {
                        alert("Errore nel recupero dei dati della bicicletta.");
                    }
                });
            }

            $("#modifica").click(function() {
                modifica();
            });

            $("#tornaIndietro").click(function() {
                window.location = "rimuoviBici.php";
            });
        });

        function modifica()
        {
            var gps = $('#gps').val().trim();
            var rfid = $('#rfid').val().trim();
            var latitude = $('#latitude').val().trim();
            var longitude = $('#longitude').val().trim();

            if (!gps || !rfid || !latitude || !longitude) {
                alert("Tutti i campi sono obbligatori");
                return false;
            }

            if (!/^\d{5}$/.test(gps)) {
                alert("Il codice del GPS deve essere di 5 cifre");
                return false;
            }

            if (!/^\d{4}$/.test(rfid)) {
                alert("Il codice RFID deve essere di 4 cifre.");
                return false;
            }

            var dati = {
                id: idBici,
                gps: gps,
                rfid: rfid,
                latitude: latitude,
                longitude: longitude
            };

            $.get("../../backend/updateBici.php", dati)
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
                <h2 class="card-title text-center">Modifica la bicicletta</h2>
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gps">Codice GPS (5 cifre)</label>
                                <input type="number" class="form-control" id="gps">
                            </div>
                            <div class="form-group">
                                <label for="rfid">Codice RFID (4 cifre)</label>
                                <input type="number" class="form-control" id="rfid">
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    <button type="button" class="btn btn-secondary" id="tornaIndietro">Torna alla Home Admin</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
