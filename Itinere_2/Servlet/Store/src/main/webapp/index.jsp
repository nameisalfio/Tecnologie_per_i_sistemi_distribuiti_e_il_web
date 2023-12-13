<!--
    data la tabella  prodotti con i seguenti campi:
    id (chiave primaria, autoincrement)
    nome_prodotto (stringa)
    giacenza (intero)
    prezzo (decimale)

    creare una o più pagine in php/html che implementino le funzioni CRUD.

    1) CR (obbligatorio)

    1.1) inserimento di un nuovo prodotto
    1.2) stampa dell'elenco dei prodotti con giacenza > 0

    2) UD (facoltativo)

    2.1) aggiungere alla lista (punto 1.2) un link o un bottone "compra" che permette di acquistare il prodotto. 
    Una volta acquistato, la giacenza del prodotto verrà decrementata.
    2.2) aggiungere alla lista (punto 1.2) un link o un bottone "elimina" che permette di cancellare l'intero record
-->

<html>
    <head>
        <link rel='stylesheet' href='css/style.css'>
    </head>
    
    <body>
        <h2>Magazzino</h2>

        <form action="/store" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome"><br>
            <label for="giacenza">Giacenza:</label>
            <input type="text" name="giacenza"><br>
            <label for="prezzo">Prezzo:</label>
            <input type="text" name="prezzo"><br><br>
            <button name="action" value="create">Inserisci</button>
        </form>

        <br>

        <form action="/store" method="GET">
            <button>Vedi tutti</button>
        </form>

    </body>
</html>
