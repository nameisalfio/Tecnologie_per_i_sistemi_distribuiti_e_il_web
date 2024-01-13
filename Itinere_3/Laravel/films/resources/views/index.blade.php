<!--
    Implementare uno script in PHP che consenta di gestire un database di film. 
    Il database di film dovrebbe avere i seguenti campi:

    Titolo
    Anno
    Paese
    Regista

    Le funzioni richieste sono:

    - CreateFilm(): Permette di inserire un nuovo record nel database con le informazioni specificate.

    - ReadAllFilms(): Restituisce tutti i film presenti nel database.

    - UpdateFilm(): Aggiorna le informazioni di un film nel database in base al vecchio titolo.

    - DeleteFilm(): Elimina un film dal database in base al titolo.

-->

<html>
    <body>
        <h2>Films</h2>

        <form action="/insert" method="POST">
            @csrf
            
            Titolo:<input type="text" name="titolo"><br>
            Anno:<input type="text" name="anno"><br>
            Paese:<input type="text" name="paese"><br>
            Regista:<input type="text" name="regista"><br><br>
            <button>Inserisci film</button>
        </form>
        
        <br>

        <form action="/read" method="GET">
            <button>Vedi tutti</button>
        </form>

    </body>
</html>