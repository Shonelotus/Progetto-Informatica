class mapAdmin {
    constructor() {
      this.map = null;
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
  
      this.fetchMarkers();
  
      // Aggiungi un listener per gestire il clic sulla mappa per aggiungere un marker
      this.map.addListener("click", (event) => {
        const nuovaPosizione = event.latLng;
        this.aggiungiMarker(nuovaPosizione);
      });
  
      // Carica i marker esistenti una volta che la mappa è stata inizializzata
      this.fetchMarkers();
    }
  
    async aggiungiMarker(posizione) {
      const nome = prompt("Inserisci il nome del marker:");
      const codice = prompt("Inserisci il codice della stazione:");
      const numeroSlot = prompt("Inserisci il numero degli slot:");
  
      if (!nome || !codice || !numeroSlot) return;
  
      try {
        // Invia i dati del nuovo marker al backend per salvarli nel database
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
  
        if (result.status) {
          alert(result.message);
          this.fetchMarkers();
        } else {
          alert(result.message);
        }
      } catch (error) {
        console.error("Errore durante l'aggiunta del marker:", error);
      }
    }
  

    //funzione che mi permette di caricare i marker che ci sono nella mappa
    fetchMarkers()
    {
        //richiamo il servizio in get
        $.get("../../backend/getMarkers.php", (data) => 
            {
                //per ogni marker mi salvo tutti i dati
                data.forEach((markerData) => 
                    {   
                        const marker = new google.maps.Marker({
                        position: 
                        {
                            lat: parseFloat(markerData.latitude),
                            lng: parseFloat(markerData.longitude),
                        },
                        map: this.map,
                        title: markerData.name,
                        codice: markerData.codice,
                        numeroSlot: markerData.numSlot,
          });
  
          //lo inserisco nella mappa
        const infowindow = new google.maps.InfoWindow(
        {
            content: `<div><h2>${markerData.nome}</h2><p>${markerData.codice}</p><p>${markerData.numeroSlot}</p></div>`,
        });
  
        //se clicco sul marker devo avere la possibilià di visualizzare le impostazioni o eliminarlo
        marker.addListener("click", () => 
        {
            infowindow.open(this.map, marker);
        });
        });
      }, "json");
    }
  }
  