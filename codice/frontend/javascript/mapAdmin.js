class mapAdmin {
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
  
      // Aggiungi un listener per gestire il clic sulla mappa per aggiungere un marker
      this.map.addListener("click", (event) => {
        const nuovaPosizione = event.latLng;
        this.aggiungiMarker(nuovaPosizione);
      });
  
      // Carica i marker esistenti una volta che la mappa è stata inizializzata
      this.fetchMarkers();
    }
  
    async aggiungiMarker(posizione) {
      const nome = prompt("Inserisci il nome della stazione:");
      const codice = prompt("Inserisci il codice della stazione:");
      const numeroSlot = prompt("Inserisci il numero degli slot:");
  
      if (!nome || !codice || !numeroSlot) return;
  
      // Invia i dati del nuovo marker al backend per salvarli nel database
      try {
        const response = await fetch("../../backend/addMarker.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            name: nome,
            codice: codice,
            numSlot: numeroSlot,
            lat: posizione.lat(),
            long: posizione.lng(),
          }),
        });
  
        const result = await response.json();
  
        if (response.ok && result.status) {
          alert(result.message);
        } else {
          alert(result.message);
          return;
        }
  
        this.fetchMarkers();
      } catch (error) {
        console.error("Errore durante l'aggiunta del marker:", error);
      }
    }
  
    async eliminaMarker(marker, markerId) {
      // chiedo conferma all'utente prima di eliminare il marker
      const conferma = confirm("Sei sicuro di voler eliminare la stazione?");
      if (!conferma) {
        return; // Se l'utente annulla, interrompe l'esecuzione del metodo
      }
  
      // Invia la richiesta al server per eliminare il marker
      try {
        const response = await fetch("../../backend/deleteMarker.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ id: markerId }),
        });
  
        const result = await response.json();
  
        if (result.status) {
          alert(result.message);
          // Rimuovi il marker dalla mappa
          marker.setMap(null);
          // Rimuovi il marker dall'array dei marker
          this.markers = this.markers.filter(m => m.id !== markerId);
        } else {
          alert(result.message);
        }
  
        this.fetchMarkers();
      } catch (error) {
        console.error("Errore durante l'eliminazione del marker:", error);
      }
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
  