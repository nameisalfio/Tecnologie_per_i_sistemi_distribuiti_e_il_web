<html>
    <body>
        <h3>Aggiorna Libro</h3>

        <form action="/books/update" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="isbn" value="{{$book->isbn}}">
            Titolo: <input type="text" name="titolo" value="{{$book->titolo}}"><br>
            Autore: <input type="text" name="autore" value="{{$book->autore}}"><br>
            Prezzo: <input type="text" name="prezzo" value="{{$book->prezzo}}"><br><br>
            
            <button type="submit">Salva Modifiche</button>
        </form>

        <br><a href='/'><button>Torna alla home</button></a>
    </body>
</html>
