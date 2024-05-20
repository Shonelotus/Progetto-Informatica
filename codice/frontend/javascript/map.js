// Initialize and add the map
let map;

async function initMap() {
  // coordinate di milano 45.47402057114726, 9.187685303465328
  const posizione = { lat: 45.47402057114726, lng: 9.187685303465328};
  
  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  map = new Map(document.getElementById("map"), {
    zoom: 12,
    center: posizione,
    mapId: "DEMO_MAP_ID",
  });

  const marker = new AdvancedMarkerElement({
    map: map,
    position: posizione,
    title: "Stazione bici",
  });
}



initMap();
