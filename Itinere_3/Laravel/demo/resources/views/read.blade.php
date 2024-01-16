<html>
    <body>
        <h3>Tutti i prodotti:</h3>
        
        @foreach($products as $product)
            <form action="/form" method="POST">
                @csrf
                
                <p>ID: {{$product->id}} - Nome: {{$product->nome}} - Giacenza: {{$product->giacenza}} - Prezzo: {{$product->prezzo}}</p>
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="hidden" name="nome" value="{{$product->nome}}">
                <input type="hidden" name="giacenza" value="{{$product->giacenza}}">
                <input type="hidden" name="prezzo" value="{{$product->prezzo}}">
                <input type="submit" name="action" value="Modifica">
                <input type="submit" name="action" value="Rimuovi">
            </form>
        @endforeach
        
        <br><a href='/'><button>Torna alla home</button></a>

    </body>
</html>