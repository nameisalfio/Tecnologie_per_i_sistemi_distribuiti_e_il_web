<html>
    <body>
        <h1>Crea nuova Squadra</h1>

        <form action="{{ route('teams.store') }}" method="POST">
            @csrf

            Nome:<input type="text" name="nome" required>
            Stadio:<input type="text" name="stadio" required>
            Anno di fondazione:<input type="text" name="anno_fondazione" required>
            <button type="submit">Crea Squadra</button>
        </form>
    </body>
</html>