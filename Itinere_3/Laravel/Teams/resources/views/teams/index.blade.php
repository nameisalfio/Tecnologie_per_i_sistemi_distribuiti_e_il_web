<html>
    <body>
        <h1>Elenco Squadre</h1>

        @foreach ($teams as $team)
            <p>
                ID: {{ $team->id }} - Nome: {{ $team->nome }} - Stadio: {{ $team->stadio }} - Anno di fondazione: {{ $team->anno_fondazione }} 
                <a href="{{ route('teams.show', $team->id) }}">Mostra</a>
                <a href="{{ route('teams.edit', $team->id) }}">Modifica</a>
            </p>
        @endforeach

        <a href="{{ route('teams.create') }}"><button> Nuova Squadra</button></a>
        <br><br><a href="../"><button>Home</button></a>

    </body>
</html>