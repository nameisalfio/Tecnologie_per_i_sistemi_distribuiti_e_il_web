<html>
    <body>
        <h1>Crea Giocatore</h1>

        <form action="{{ route('players.store') }}" method="POST">
            @csrf

            Nome:<input type="text" name="nome" required>
            Numero della maglia:<input type="text" name="no_maglia" required>
            Squadra:
            <select name="team" required>
                @foreach($players as $player)
                    <option value="{{ $team->id }}">{{ $team->nome }}</option>
                @endforeach
            </select>
            <button type="submit">Crea Giocatore</button>
        </form>
    </body>
</html>