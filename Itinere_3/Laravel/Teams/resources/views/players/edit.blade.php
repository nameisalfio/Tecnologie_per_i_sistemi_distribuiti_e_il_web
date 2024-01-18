<html>
    <body>
    <form action="{{ route('players.update', $player->id) }}" method="post">
        @csrf
        @method('put')

        Nome:<input type="text" name="nome" value="{{ $player->nome }}" required>
        Numero di maglia:<input type="text" name="no_maglia" value="{{ $player->prezzo }}" required>
        Squadra:
        <select name="team" required>
            @foreach($players as $player)
                <option value="{{ $team->id }}">{{ $team->nome }}</option>
            @endforeach
        </select>

        <button type="submit">Modifica Gioco</button>
    </form>
    </body>
</html>