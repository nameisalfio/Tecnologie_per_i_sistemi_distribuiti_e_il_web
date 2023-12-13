// Inizializza un array vuoto per memorizzare gli ordini aggiunti
const ordiniAggiunti = [];

// Funzione per aggiungere un piatto all'array
function elimina(id_ordine, id_tavolo) {
	const nuovoPiatto = { id_ordine, id_tavolo };
	ordiniAggiunti.push(nuovoPiatto);
	inviaOrdini()
}

// Funzione per inviare gli ordini alla servlet
function inviaOrdini() {
	// Verifica se ci sono ordini da inviare
	if (ordiniAggiunti.length === 0) {
		alert('Nessun ordine da inviare.');
		return;
	}

	// Crea un oggetto JSON con gli ordini
	const datiDaInviare = JSON.stringify(ordiniAggiunti);

	// Effettua la richiesta HTTP POST
	fetch('elimina', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: datiDaInviare
	})

		.then(response => {
			
			if (response.ok) {
				const div = document.getElementById('notifica');
				
				div.innerHTML = 'Ordini inviati con successo';
				ordiniAggiunti.length = 0;

			} else {
				const div = document.getElementById('notifica_err');
				div.innerHTML = 'Errore durante l\'invio degli ordini.';
			}
		})
		.catch(error => {
			location.reload();
			console.error('Errore durante la richiesta:', error);
			/*alert('Errore durante l\'invio degli ordini.');*/
		});
}




