<html>
    <body>
        <h2>Films</h2>

        @if(!$films->isEmpty())
            @foreach($films as $f)
            <form action="/update" method="GET">
                <p>ID: {{$f->id}} - Titolo: {{$f->titolo}} - Anno: {{$f->anno}} - Paese: {{$f->paese}} - Regista: {{$f->regista}}</p>
                <button>Aggiorna</button>
                <input type="hidden" name="id" value="{{$f->id}}">
                <input type="hidden" name="titolo" value="{{$f->titolo}}">
                <input type="hidden" name="anno" value="{{$f->anno}}">
                <input type="hidden" name="paese" value="{{$f->paese}}">
                <input type="hidden" name="regista" value="{{$f->regista}}">
            </form>

            <form action="/delete" method="POST">
                @csrf 
                @method('DELETE')

                <button>Rimuovi</button>
                <input type="hidden" name="id" value="{{$f->id}}">
            </form>
            @endforeach
        @else
            <p>Nessun film presente</p>
        @endif

        <br><a href="/"><button>Torna alla homepage</button></a>
    </body>
</html>