<html>
    <body>
        <h2>Magazine</h2>
        
        @if(!$products->isEmpty())
            @foreach($products as $p)
                <form action="/update" method="GET">
                    @csrf

                    <p>ID: {{$p->id}} - Nome: {{$p->nome_prodotto}} - Giacenza: {{$p->giacenza}} - Prezzo: {{$p->prezzo}}</p>
                    <button>Aggiorna</button>
                    <input type="hidden" name="id" value="{{$p->id}}">
                    <input type="hidden" name="nome_prodotto" value="{{$p->nome_prodotto}}">
                    <input type="hidden" name="giacenza" value="{{$p->giacenza}}">
                    <input type="hidden" name="prezzo" value="{{$p->prezzo}}">
                </form>
                <form action="/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Rimuovi</button>
                    <input type="hidden" name="id" value="{{$p->id}}">
                </form>
            @endforeach
        @else
            <p>Non ci sono prodotti disponibili</p>
        @endif

        <br><a href='/'><button>Torna alla homepage</button></a>
        
    </body>
</html>