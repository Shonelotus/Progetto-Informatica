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
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-center">Login</h2>
                        <form>
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="text" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control">
                            </div>
                            <button id="invia" type="button" class="btn btn-primary btn-block">Login</button>
                            <button id="home" type="button" class="btn btn-secondary btn-block">Homepage</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkCred() 
        {
            $.get("../../backend/checkCred.php", {
                email: $('#email').val(),
                password: $('#password').val(),
            }, function(data) {
                printResponse(data["status"]);
            });
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
                window.location = "homepage.php";
            }
        }

        $(document).ready(function() {
            $("#invia").click(function() {
                checkCred();
            });
            $("#home").click(function() {
                window.location = "index.php";
            });
        });
    </script>
</body>
</html>
