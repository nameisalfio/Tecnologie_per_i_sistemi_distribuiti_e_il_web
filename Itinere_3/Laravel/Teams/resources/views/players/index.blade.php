<html>
    <body>
        <h1>Elenco Giocatori</h1>

        @foreach ($players as $player)
            <p>
                ID: {{ $player->id }} - Nome: {{ $player->nome }} - Numero di maglia: {{ $player->n_maglia }} - Squadra: {{ $player->team }}
                <a href="{{ route('players.show', $player->id) }}"><button>Mostra</button></a>
                <a href="{{ route('players.edit', $player->id) }}"><button>Modifica</button></a>
            </p>
        @endforeach

        <a href="{{ route('players.create') }}">Crea Nuovo Gioco</a>

        <br><br><a href="../"><button>Home</button></a>
    </body>
</html>