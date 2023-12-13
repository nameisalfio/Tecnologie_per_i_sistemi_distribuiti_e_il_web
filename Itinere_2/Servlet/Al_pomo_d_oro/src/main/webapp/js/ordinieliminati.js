function aggiorna(event) {
    // Otteniamo il form genitore dell'elemento cliccato
    let formElement = event.target.closest("form");

    if (formElement) {
       /* let formData = new FormData(formElement);*/
        let data= new FormData(this);
       let method=this.getAttribute("method");
        let action=this.getAttribute("action");
        let headers = new Headers();

        let config = {
            method: method,
            headers: headers,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        };

        fetch(action, config)
            .then(response => {
                if (response.ok) {
                    
                }
            })
            .catch(error => {
                console.error("Errore durante la richiesta Fetch:", error);
            });
    }
}
