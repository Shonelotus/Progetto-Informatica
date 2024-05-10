<?php

if(!isset($_SESSION))
{
    session_start();
}

if(!isset($_SESSION["id"]))
{
    session_destroy();
}
else if($_SESSION["admin"] == 0)
{
    header('Location: index.php');
}
else
{
    header('Location: adminPage.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() 
        {

            $("#registra").click(function() 
            {
                signUp();
            });

            $("#tornaIndietro").click(function() 
            {
                window.location = "index.php";
            });
        });

        function signUp()
        {
            var username = $('#username').val();
            var password = $('#password').val();
            var email = $('#email').val();

            if (username === "" || password === "" || email === "") 
            {
                alert("Per favore, completa tutti i campi");
                return;
            }

            var dati = 
            {
                nome: nome,
                cognome: cognome,
                email: email,
                password: password,
                numeroTessera: numeroTessera,
                numeroCartaCredito: numeroCartaCredito,
                stato: stato,
                provincia: provincia,
                paese: paese,
                cap: cap,
                via: via
            };

            $.get("../../backend//registration.php", dati, function(data) 
            {
                printResponse(data["status"]);
            });
        }

        function printResponse(status)
        {
            if(status === false)
            {
                alert("Registrazione fallita");
            }
            else if(status === true)
            {
                window.location = "index.php";   
            }
        }
        </script>
    </head>

    <body>
    <div id="login-container">
        <div class="login-form">
            <h2>Registra utente</h2>

            <div id="input">
                <label for="nome">Nome</label>
                <input type="text" id="nome"> <br>

                <label for="cognome">cognome</label>
                <input type="text" id="cognome"> <br>

                <label for="email">Email: </label>
                <input type="text" id="email"> <br>

                <label for="password">Password: </label>
                <input type="password" id="password"> <br>

                <label for="numeroTessera">Numero tessera: </label>
                <input type="text" id="numeroTessera"> <br>

                <label for="numeroCartaCredito">Numero carta di credito: </label>
                <input type="text" id="numeroCartaCredito"> <br>

                <label for="stato">Stato: </label>
                <input type="text" id="stato"> <br>

                <label for="provincia">Provincia: </label>
                <input type="text" id="provincia"> <br>

                <label for="paese">Paese: </label>
                <input type="text" id="paese"> <br>

                <label for="cap">Cap: </label>
                <input type="text" id="cap"> <br>

                <label for="via">Via: </label>
                <input type="text" id="via"> <br>

                <button id="registra">Registrati</button>
                <button id="tornaIndietro">Torna alla login</button>

            </div><br>
                
                
        </div>
    </div>
    </body>
</html>
