class mapAdmin 
{
  constructor() {
    this.map = null;
    this.markers = [];
  }

  async initMap() {
    // coordinate di Milano
    const posizione = { lat: 45.47402057114726, lng: 9.187685303465328 };

    // Request needed libraries.
    const { Map } = await google.maps.importLibrary("maps");

    this.map = new Map(document.getElementById("map"), {
      zoom: 12,
      center: posizione,
      mapId: "DEMO_MAP_ID",
    });

    // Carica i marker esistenti una volta che la mappa è stata inizializzata
    this.fetchMarkers();
  }


  async fetchMarkers() {
    try {
      const response = await fetch("../../backend/getMarkers.php");
      const data = await response.json();

      // Rimuovi tutti i marker esistenti
      this.markers.forEach(({ marker }) => marker.setMap(null));
      this.markers = [];

      
      data.forEach((markerData) => {
        const marker = new google.maps.Marker({
          position: {
            lat: parseFloat(markerData.latitude),
            lng: parseFloat(markerData.longitude),
          },
          map: this.map,
          title: markerData.name,
          id: markerData.id, // Assuming markerData includes an 'id' field
          codice: markerData.codice,
          numeroSlot: markerData.numSlot,
        });

        this.markers.push({
          id: markerData.id,
          marker: marker,
        });

        const infowindow = new google.maps.InfoWindow({
          content: `<div><h2>${markerData.nome}</h2><p>${markerData.codice}</p><p>${markerData.numeroSlot}</p></div>`,
        });

        marker.addListener("click", () => {
          infowindow.open(this.map, marker);
        });

        marker.addListener("rightclick", () => {
          this.eliminaMarker(marker, markerData.id);
        });
      });
    } catch (error) {
      console.error("Errore durante il recupero dei marker:", error);
    }
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const mapAdminInstance = new mapAdmin();
  mapAdminInstance.initMap();
});

