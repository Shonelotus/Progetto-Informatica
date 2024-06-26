<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["isAdmin"])) {
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
            Gestione Biciclette
        </a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="homeAdmin()">Home Admin</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <h1 class="header-text">Gestione Biciclette</h1>

        <table id="tabella-biciclette" class="table table-striped table-light">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">GPS</th>
                    <th scope="col">RFID</th>
                    <th scope="col">Latitudine</th>
                    <th scope="col">Longitudine</th>
                    <th scope="col">Elimina</th>
                    <th scope="col">Modifica</th>
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
        function showElements() {
            $.get("../../backend/getAllBici.php", {}, function (data) {
                if (data.biciclette) {
                    printAll(data.biciclette);
                } else {
                    alert("Errore nel recupero dei dati delle biciclette.");
                }
            }).fail(function () {
                alert("Errore di connessione con il server.");
            });
        }

        // Funzione per stampare tutte le biciclette nella tabella
        function printAll(biciclette) {
            var $tbody = $("#tabella-biciclette tbody");
            $tbody.empty();

            $.each(biciclette, function (i, bici) {
                var riga = $("<tr>");
                riga.append($("<td>").text(bici.gps));
                riga.append($("<td>").text(bici.rfid));
                riga.append($("<td>").text(bici.latitudine));
                riga.append($("<td>").text(bici.longitudine));

                // Bottone Elimina
                var bottoneElimina = $("<button>")
                    .text("Elimina")
                    .addClass("btn btn-danger")
                    .attr("data-id", bici.id)
                    .click(() => {
                        var biciId = bici.id;
                        var conferma = confirm("Eliminare il prodotto definitivamente?");
                        if (conferma) {
                            $.get("../../backend/deleteBici.php", { id: biciId }, function (data) {
                                if (data.status) {
                                    alert("Bicicletta eliminata correttamente");
                                    showElements();
                                } else {
                                    alert("Errore durante l'eliminazione della bicicletta");
                                }
                            }).fail(function () {
                                alert("Errore di connessione con il server.");
                            });
                        } else {
                            alert("La bicicletta non è stata eliminata");
                        }
                    });
                var cellaBottoneElimina = $("<td>").append(bottoneElimina);

                // Bottone Modifica
                var bottoneModifica = $("<button>")
                    .text("Modifica")
                    .addClass("btn btn-primary")
                    .attr("data-id", bici.id)
                    .click(() => {
                        var biciId = bici.id;
                        $.get("../../backend/setBiciId.php", { id: biciId }, function (data) {
                            if (data.status) {
                                window.location = "modificaBici.php";
                            } else {
                                alert("C'è stato un errore");
                            }
                        }).fail(function () {
                            alert("Errore di connessione con il server.");
                        });
                    });
                var cellaBottoneModifica = $("<td>").append(bottoneModifica);

                riga.append(cellaBottoneElimina);
                riga.append(cellaBottoneModifica);

                $tbody.append(riga);
            });

            if (table) {
                table.destroy();
            }

            // Inizializza DataTables
            table = $('#tabella-biciclette').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "Nessun dato disponibile nella tabella",
                    "info": "Mostra _START_ a _END_ di _TOTAL_ voci",
                    "infoEmpty": "Mostra 0 a 0 di 0 voci",
                    "infoFiltered": "(filtrato da _MAX_ voci totali)",
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

        function homeAdmin() {
            window.location.href = "adminPage.php";
        }

        $(document).ready(function() {
            showElements();
        });
    </script>
</body>

</html>
