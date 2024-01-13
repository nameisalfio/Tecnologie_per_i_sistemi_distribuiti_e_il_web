<html>
    <body>
        <h3>Tutti i libri:</h3>
        
        @foreach($books as $book)
            <form action="/update" method="GET">
                @csrf

                <p>Isbn: {{$book->isbn}} - Titolo: {{$book->titolo}} - Autore: {{$book->autore}} - Prezzo: {{$book->prezzo}}</p>
                <button type="submit">Aggiorna</button>
                <input type="hidden" name="isbn" value="{{$book->isbn}}">
                <input type="hidden" name="titolo" value="{{$book->titolo}}">
                <input type="hidden" name="autore" value="{{$book->autore}}">
                <input type="hidden" name="prezzo" value="{{$book->prezzo}}">
            </form>

            <form action="/delete" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">Elimina</button>
                <input type="hidden" name="isbn" value="{{$book->isbn}}">
            </form><br>
        @endforeach
        
        <br><a href='/'><button>Torna alla home</button></a>

    </body>
</html>

