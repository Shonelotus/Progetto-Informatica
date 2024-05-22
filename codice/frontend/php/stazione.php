<?php
$key = parse_ini_file(realpath("../../../key.ini"));
$tokenKey = $key['MAPS_KEY'];
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azioni Admin</title>
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
            border: 2px solid #007bff;
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
    </style>
    <script>

        var tokenKey = "<?php echo $tokenKey; ?>";

        src="https://maps.googleapis.com/maps/api/js?key="+tokenKey+"&loading=async&callback=initMap">
              (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
                key: tokenKey,
                v: "weekly",
                // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
                // Add other bootstrap parameters as needed, using camel case.
              });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../javascript/mapAdmin.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Azioni Admin</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="homeAdmin()">Home Admin</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="header-text">Gestione delle stazioni</h1>
                <p class="lead">Cliccare sulla mappa per aggiungere una stazione, cliccare col tasto destro per rimuoverla</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12" id="map" style="height: 500px;">
                <!-- The map container -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

        function homeAdmin()
        {
            window.location.href = "adminPage.php"
        }

        $(document).ready(function() {
            var _mapAdmin = new mapAdmin();
            _mapAdmin.initMap();
        });
    </script>
</body>

</html>
