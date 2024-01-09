<html>
    <body>
        <h3>Tutti i libri:</h3>
        
        @foreach($books as $book)
            <form action="/books/form" method="GET">
                <p>Isbn: {{$book->isbn}} - Titolo: {{$book->titolo}} - Autore: {{$book->autore}} - Prezzo: {{$book->prezzo}}</p>
                @csrf
                <button type="submit">Aggiorna</button>
                <input type="hidden" name="isbn" value="{{$book->isbn}}">
            </form>

            <form action="/books/delete" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Elimina</button>
                <input type="hidden" name="isbn" value="{{$book->isbn}}">
            </form><br>
        @endforeach
        
        <br><a href='/'><button>Torna alla home</button></a>

    </body>
</html>

