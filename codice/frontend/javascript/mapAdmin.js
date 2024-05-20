class mapAdmin 
{
    constructor() 
    {
      this.map = null;
    }
  
    async initMap() 
    {
      // coordinate di Milano
      const posizione = { lat: 45.47402057114726, lng: 9.187685303465328 };
  
      // Request needed libraries.
      const { Map } = await google.maps.importLibrary("maps");
  
      this.map = new Map(document.getElementById("map"), {
        zoom: 12,
        center: posizione,
        mapId: "DEMO_MAP_ID",
      });
  
      // Aggiungi un listener per gestire il clic sulla mappa per aggiungere un marker
      this.map.addListener("click", (event) => {
        const nuovaPosizione = event.latLng;
        this.aggiungiMarker(nuovaPosizione);
      });
  
      // Carica i marker esistenti una volta che la mappa è stata inizializzata
      this.fetchMarkers();
    }
  
    async aggiungiMarker(posizione) 
    {
      const nome = prompt("Inserisci il nome del marker:");
      if (!nome) return; // Se l'utente ha cliccato "Annulla", non fare nulla
  
      // Aggiungi un nuovo marker alla mappa
      const nuovoMarker = new google.maps.Marker({
        position: posizione,
        map: this.map,
        title: nome,
      });
  
      // Invia i dati del nuovo marker al backend per salvarli nel database
      const response = await fetch("../../backend/addMarker.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          nome: nome,
          latitudine: posizione.lat(),
          longitudine: posizione.lng(),
        }),
      });
  
      if (response.ok) {
        alert("Marker aggiunto con successo!");
      } else {
        alert("Si è verificato un errore durante l'aggiunta del marker.");
      }
  
      this.fetchMarkers();
    }
  
    fetchMarkers() 
    {
      $.get("getMarkers.php", (data) => {
        data.forEach((markerData) => {
          const marker = new google.maps.Marker({
            position: {
              lat: parseFloat(markerData.latitude),
              lng: parseFloat(markerData.longitude),
            },
            map: this.map,
            title: markerData.name,
          });
  
          const infowindow = new google.maps.InfoWindow({
            content: `<div><h2>${markerData.name}</h2><p>${markerData.description}</p></div>`,
          });
  
          marker.addListener("click", () => {
            infowindow.open(this.map, marker);
          });
        });
      }, "json");
    }
  }
  