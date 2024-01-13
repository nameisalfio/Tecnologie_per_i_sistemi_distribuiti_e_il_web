<html>

    <body>
        <h2>Magazine</h2>

        <form action="/insert" method="POST">
            @csrf 
            
            Nome:<input type="text" name="nome_prodotto" required><br>
            Giacenza:<input type="text" name="giacenza" required><br>
            Prezzo:<input type="text" name="prezzo" required><br><br>
            <button>Inserisci</button>
        </form>
        <br>
        <form action="/read" method="GET">
            <button>Vedi tutti</button>
        </form>

    </body>
</html>
