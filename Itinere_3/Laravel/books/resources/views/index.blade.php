<html>
    <body>
        <h2>Libri</h2>

        <form action="/create" method="POST">
            @csrf
            
            Titolo:<input type='text' name='titolo' required><br>
            Autore:<input type='text' name='autore' required><br>
            Prezzo:<input type='text' name='prezzo' required><br><br>
            <button>Inserisci</button>
        </form>
        <br>

        <form action="/read" method="GET">
            <button>Vedi tutti</button>
        </form>

    </body>
</html>
