<html>
    <body>
        <h2>Products</h2>

        <form action="/create" method="POST">
            @csrf
            
            Nome:<input type='text' name='nome' required><br>
            Giacenza:<input type='text' name='giacenza' required><br>
            Prezzo:<input type='text' name='prezzo' required><br><br>
            <button>Inserisci</button>
        </form>
        <br>

        <form action="/read" method="GET">
            <button>Vedi tutti</button>
        </form>

    </body>
</html>
