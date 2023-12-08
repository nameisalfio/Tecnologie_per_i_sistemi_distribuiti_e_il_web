<!--
    Consegna per la Realizzazione di una Web App CRUD in Java e PHP

    Obiettivo:
    Sviluppare uno o più script PHP e pagine HTML che implementino le funzionalità "CRUD" (Create, Read, Update, Delete) per una nuova tabella 
    denominata "courses".

    Richieste:

    Visualizzazione dei Corsi:

    Creare un form HTML con un bottone che, quando cliccato, richieda al server la lista dei corsi presenti nella tabella "courses" e visualizzi 
    i risultati in una pagina HTML. Utilizzare PHP per recuperare i dati dal database e mostrare la lista nella pagina HTML.

    Inserimento di Nuovi Corsi:

    Implementare un form HTML che permetta l'inserimento di un nuovo corso nella tabella "courses".
    Al termine dell'inserimento, verificare che la nuova entry sia visibile nella lista dei corsi (mostrare tutti i corsi presenti).

    Facoltative:

    Aggiornamento dei Corsi:

    Nella lista dei corsi (come da punto 1), rendere l'attributo "codice_corso" di ogni record un link. Cliccando sul link, si deve accedere a un 
    form di aggiornamento per il corso corrispondente.

    Eliminazione dei Corsi:

    Aggiungere un bottone nel form di aggiornamento (punto 1) per l'eliminazione del corso corrente dalla tabella "courses".
-->

<html>
    <body>
        <h2>University</h2>

        <p>Tutti i corsi</p>
        <form action="/servlet" method="GET">
            <button>Visualizza tutti i corsi</button>
        </form><br>

        <p>Inserisci un nuovo corso</p>
        <form action="/servlet" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>
            <label for="descrizione">Descrizione:</label>
            <input type="text" id="descrizione" name="descrizione" required><br>
            <label for="crediti">Crediti:</label>
            <input type="text" id="crediti" name="crediti" required><br><br>
            <input type="hidden" name="action" value="create">
            <button>Inserisci corso</button>
        </form>

    </body>
</html>
