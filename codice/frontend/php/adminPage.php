<?php
/*if(!isset($_SESSION))
{
    session_start();
}

if(!isset($_SESSION["id"]))
{
    session_destroy();
}
else if($_SESSION["admin"] == 0)
{
    header('Location: homepage.php');
}
else
{
    header('Location: adminPage.php');
}*/
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(90deg, rgba(0,123,255,1) 0%, rgba(40,167,69,1) 100%);
            color: #fff;
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }
        .container {
            max-width: 600px; /* Set a maximum width to the container */
            margin-top: 100px; /* Add margin to top */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border: none; /* Remove border */
            border-radius: 15px; /* Add border-radius */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add box-shadow */
            padding: 20px; /* Add padding */
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function controlAction() 
        {
            let scelta = $('#scelta').val();
            let azione = $('#azione').val();
            
            //se è una bicicletta e devo modificarla allora reindirizzo alla pagina bicicletta.php
            if(scelta == "Bicicletta")
            {
                if(azione == "Modifica")
                {
                    window.location.href = "bicicletta.php"
                }
                else
                {
                    alert("Operazione non permessa");
                }
            }
            //altrimenti se è uno slot o una stazione reindirizzo alla pagina stazioneSlot.php
            else if(scelta == "Slot" || scelta == "Stazione")
            {
                if(azione != "Modifica")
                {
                    window.location.href = "stazioneSlot.php"
                }
                else
                {
                    alert("Operazione non permessa");
                }
            }
        }

        $(document).ready(function() 
        {
            $("#invia").click(function() 
            {
                controlAction();
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Gestione Admin</h2>
                <form>
                    <div class="form-group">
                        <label for="scelta">Seleziona un'opzione</label>
                        <select id="scelta" class="form-control">
                            <option>Stazione</option>
                            <option>Slot</option>
                            <option>Bicicletta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="azione">Seleziona un'azione</label>
                        <select id="azione" class="form-control">
                            <option>Aggiungi</option>
                            <option>Rimuovi</option>
                            <option>Modifica</option>
                        </select>
                    </div>
                    <button type="button" id="invia" class="btn btn-primary">Vai alla pagina</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
