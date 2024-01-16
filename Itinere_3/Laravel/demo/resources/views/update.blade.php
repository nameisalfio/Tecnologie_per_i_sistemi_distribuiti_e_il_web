<html>
    <body>
        <h3>Aggiorna prodotto</h3>

        <form action="/update" method="POST">
            @csrf
            
            Nome: <input type="text" name="nome" value="{{$product->nome}}"><br> 
            Giacenza: <input type="text" name="giacenza" value="{{$product->giacenza}}"><br>
            Prezzo: <input type="text" name="prezzo" value="{{$product->prezzo}}"><br><br>
            
            <button type="submit">Salva Modifiche</button>
            <input type="hidden" name="id" value="{{$product->id}}">
        </form>

        <br><a href='/'><button>Torna alla home</button></a>
    </body>
</html>
