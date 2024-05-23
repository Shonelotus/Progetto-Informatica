<?php
if(!isset($_SESSION))
{
    session_start();
}

if(!isset($_SESSION["isCliente"]))
{
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Biciclette</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- DataTables CSS for Bootstrap -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(90deg, rgba(0, 123, 255, 1) 0%, rgba(40, 167, 69, 1) 100%);
            color: #fff;
            overflow-x: hidden;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar-brand {
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .btn-primary,
        .btn-secondary {
            width: 150px;
            font-weight: bold;
            border-radius: 30px;
            margin-right: 10px;
        }

        .container {
            max-width: 900px;
            margin-top: 50px;
        }

        .header-text {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .lead {
            font-size: 1rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            Gestione Account
        </a>
    </nav>
    <div class="container">
        <h1 class="header-text">Gestione Account</h1>

        <table id="tabella-operazioni" class="table table-striped table-light">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Operazione</th>
                    <th scope="col">data e ora</th>
                    <th scope="col">Distanza percorsa (km)</th>
                    <th scope="col">Tariffa (€)</th>
                    <th scope="col">Codice Bici</th>
                    <th scope="col">Stazione</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS for Bootstrap -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <!-- Script JavaScript personalizzato -->
    <script>
        var table;

        // Funzione per mostrare gli elementi nella tabella
        function showElements() 
        {
            $.get("../../backend/getAllOperazioni.php", {}, function (data) 
            {
                if (data.operazioni) 
                {
                    printAll(data.operazioni);
                } else {
                    alert("Errore nel recupero dei dati delle operazioni");
                }
            }).fail(function () {
                alert("Errore di connessione con il server");
            });
        }

        function printAll(operazioni) 
        {
            var $tbody = $("#tabella-operazioni tbody");
            $tbody.empty();

            $.each(operazioni, function (i, operazione) {
                var riga = $("<tr>");
                riga.append($("<td>").text(operazione.tipo));
                riga.append($("<td>").text(operazione.data));
                riga.append($("<td>").text(operazione.distanza));
                riga.append($("<td>").text(operazione.tariffa));
                riga.append($("<td>").text(operazione.nomeStazione));
                riga.append($("<td>").text(operazione.codiceBici));
                $tbody.append(riga);
            });

            if (table) {
                table.destroy();
            }

            // Inizializza DataTables
            table = $('#tabella-operazioni').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "Nessun dato disponibile nella tabella",
                    "info": "Mostra _START_ a _END_ di _TOTAL_ elementi",
                    "infoEmpty": "Mostra 0 a 0 di 0 voci",
                    "infoFiltered": "(filtrato da _MAX_ elementi totali)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostra _MENU_ voci",
                    "loadingRecords": "Caricamento...",
                    "processing": "Elaborazione...",
                    "search": "Cerca:",
                    "zeroRecords": "Nessun record corrispondente trovato",
                    "paginate": {
                        "first": "Primo",
                        "last": "Ultimo",
                        "next": "Prossimo",
                        "previous": "Precedente"
                    },
                    "aria": {
                        "sortAscending": ": attiva per ordinare la colonna in ordine crescente",
                        "sortDescending": ": attiva per ordinare la colonna in ordine decrescente"
                    }
                },
                pageLength: 10
            });
        }

        $(document).ready(function() {
            showElements();
        });
    </script>
</body>

</html>
