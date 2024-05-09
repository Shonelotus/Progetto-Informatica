// Initialize and add the map
let map;

async function initMap() 
{
  // coordinate di milano centro
  const milano = { lat: 45.696575, lng: 9.1771399 };
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  const map = new google.maps.Map(document.getElementById("map"), 
  {
    center: milano,
    zoom: 14,
  });

  const panorama = new google.maps.StreetViewPanorama(
    document.getElementById("pano"),
    {
      position: position,
      pov: {
        heading: 34,
        pitch: 10,
      },
    },
  );

  map.setStreetView(panorama);

  window.initialize = initialize;

  const duomoPosition = { lat: 45.464667, lng: 9.191562 };
  addMarker(duomoPosition, "Duomo di Milano");
}


async function addMarker(position, title) 
{
  const marker = new AdvancedMarkerElement({
    map: map, // Riferimento alla mappa creata
    position: position, // Coordinate del marcatore
    title: title, // Testo del tooltip
  });

  // Opzioni avanzate (se necessario)
  marker.setIcon({
    url: "file:///C:/Users/Samsung/Downloads/milan-duomo-di-milano-svgrepo-com.svg", 
  });

  // Gestione eventi (facoltativo)
  marker.addListener("click", () => {
    // Azioni da eseguire quando si fa clic sul marcatore
    console.log("Marcatore cliccato:", title);
  });
}


initMap();



