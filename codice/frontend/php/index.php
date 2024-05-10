<?php
  if(!isset($_SESSION))
  {
      session_start();
  }

  if(!isset($_SESSION["id"]))
  {
      session_destroy();
  }
  else
  {
      header('Location: adminPage.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoleggioBiciclette</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script type="module" src="../javascript/map.js"></script>
    <script>

        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6q_-ycy_AMekLba8H6gXnoYI92EhMuXY&loading=async&callback=initMap">
              (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
                key: "AIzaSyC6q_-ycy_AMekLba8H6gXnoYI92EhMuXY",
                v: "weekly",
                // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
                // Add other bootstrap parameters as needed, using camel case.
              });
        
        function login() {
            window.location.href = "login.php"; // Adjust the redirection to the correct login page URL
        }

        function register() {
            window.location.href = "register.php"; // Adjust the redirection to the correct registration page URL
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <h3>Noleggio Biciclette MILANO</h3>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-auto">
                <button class="btn btn-primary" onclick="login()">Loggati</button>
            </div>
            <div class="col-auto">
                <button class="btn btn-secondary" onclick="register()">Registrati</button>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12" id="map" style="height: 400px;">
                <!-- The map container -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
