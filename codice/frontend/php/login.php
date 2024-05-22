<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(90deg, rgba(0,123,255,1) 0%, rgba(40,167,69,1) 100%);
            color: #fff;
            overflow: hidden; /* Hide scroll bars */
            height: 100vh; /* Set full height */
            display: flex; /* Use flexbox for vertical centering */
            align-items: center; /* Vertically center content */
        }
        .container {
            max-width: 400px; /* Set a maximum width to the container */
            padding: 30px; /* Add padding to increase the size */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border: none; /* Remove border */
            border-radius: 15px; /* Add border-radius */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add box-shadow */
            padding: 20px; /* Add padding to the card */
        }
        .card-title {
            font-size: 2rem; /* Adjust title font size */
            font-weight: bold; /* Add font-weight */
            color: #007bff; /* Change title color */
            margin-bottom: 20px; /* Add bottom margin */
        }
        .form-group label {
            color: #007bff; /* Change label color */
        }
        .form-control {
            border-radius: 30px; /* Add border-radius to form inputs */
            font-size: 1.2rem; /* Increase font size */
        }
        .btn-primary, .btn-secondary {
            width: 100%; /* Make buttons full width */
            border-radius: 30px; /* Add border-radius */
            font-weight: bold; /* Add font-weight */
            margin-top: 20px; /* Add top margin */
            font-size: 1.2rem; /* Increase font size */
        }
    </style>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function checkCred() 
        {
            $.get("../../backend/checkCred.php", 
            {
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
            $("#invia").click(function() 
            {
                checkCred();
            });
            $("#home").click(function() 
            {
                window.location = "index.php";
            });
        });
    </script>
</body>
</html>
</head>
<body>
    <div class="container">
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

    