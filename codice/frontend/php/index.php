<?php
    $key = parse_ini_file(realpath("../../../key.ini"));
    $tokenKey = $key['MAPS_KEY'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noleggio Biciclette</title>
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
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .btn-primary, .btn-secondary {
            width: 150px;
            font-weight: bold;
            border-radius: 30px;
        }
        #map {
            border: 2px solid #fff;
            border-radius: 15px;
        }
        .container {
            max-width: 900px; /* Set a maximum width to the container */
        }
        .header-text {
            font-size: 1.5rem; /* Adjust header text size */
        }
        .lead {
            font-size: 1rem; /* Adjust lead text size */
        }
        @media (max-width: 576px) {
            .btn-primary, .btn-secondary {
                width: 100px; /* Adjust button width on smaller screens */
            }
            .header-text {
                font-size: 1.2rem; /* Adjust header text size on smaller screens */
            }
            .lead {
                font-size: 0.9rem; /* Adjust lead text size on smaller screens */
            }
        }
        .navbar-brand img {
            height: 40px; /* Adjust the height to make the logo smaller */
            width: auto; /* Maintain the aspect ratio */
        }
    </style>
    <script type="module" src="../javascript/map.js"></script>
    <script>

        var tokenKey = "<?php echo $tokenKey; ?>";

        src="https://maps.googleapis.com/maps/api/js?key="+tokenKey+"&loading=async&callback=initMap">
              (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
                key: tokenKey,
                v: "weekly",
                // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
                // Add other bootstrap parameters as needed, using camel case.
              });
        
        function login() {
            window.location.href = "login.php"; // Adjust the redirection to the correct login page URL
        }

        function register() {
            window.location.href = "registration.php"; // Adjust the redirection to the correct registration page URL
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="../../../immagini/logo bici.png" alt="Logo">
            Noleggio Biciclette
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="register()">Registrati</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="header-text">Noleggio Biciclette MILANO</h1>
                <p class="lead">Scopri Milano in bicicletta. Noleggia una bici oggi!</p>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-auto">
                <button class="btn btn-primary" onclick="login()">Loggati</button>
            </div>
            <div class="col-auto">
                <button class="btn btn-secondary" onclick="register()">Registrati</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12" id="map" style="height: 400px;">
                <!-- The map container -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
