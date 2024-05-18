<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Admin</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>

        var risposta;

        function callService(scelta, azione)
        {
            $.get("../../backend/actionAdmin.php", 
            {
                
            }, function(data) {
                printResponse(data["status"]);
            });
        }

        function controlAction() 
        {
            let scelta = $('#scelta').val();
            let azione = $('#azione').val();

            alert(scelta);
            alert(azione);
            if(scelta == "Bicicletta")
            {
                if(azione == "Modifica")
                {
                    windows.location = "bicicletta.php"
                }
                else
                {
                    alert("Operazione non permesse");
                }
            }
            else if(scelta == "Slot" || scelta == "Stazione")
            {
                if(azione != "Modifica")
                {
                    windows.location = "stazioneSlot.php"
                }
                else
                {
                    alert("Operazione non permesse");
                }
            }

        }

        function printResponse(status) 
        {
            if (status == false) 
            {
                alert("Credenziali errate");
            } 
            else if (status === "admin") 
            {
                window.location = "adminPage.php";
            } 
            else 
            {
                // Completa il blocco else o rimuovilo se non necessario
                alert("Operazione non valida");
            }
        }

        $(document).ready(function() 
        {
            $("#invia").click(function() 
            {
                // Controlla che la scelta sia valida
                risposta = controlAction(); // Corretto il richiamo della funzione
                if(!risposta)
                {
                    alert("Non puoi fare questa operazione")
                }
                else
                {
                    //devo reindirizzare, non fare il servizio
                    let scelta = $('#scelta').val();
                    let azione = $('#azione').val();
                    callService(scelta, azione);
                }
                
            });
        });

    </script>
</head>

<body>
    <select id="scelta">
        <option>Stazione</option>
        <option>Slot</option>
        <option>Bicicletta</option>
    </select>
    <select id="azione">
        <option>Aggiungi</option>
        <option>Rimuovi</option>
        <option>Modifica</option>
    </select>
    <button name="invia" id="invia">Vai alla pagina</button>

</body>
</html>
