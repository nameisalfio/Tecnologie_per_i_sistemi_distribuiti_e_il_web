<html>
    <body>
        <h3>Tutti i libri:</h3>
        
        @foreach($books as $book)
            <form action="/form" method="POST">
                @csrf
                
                <p>Isbn: {{$book->isbn}} - Titolo: {{$book->titolo}} - Autore: {{$book->autore}} - Prezzo: {{$book->prezzo}}</p>
                <input type="hidden" name="isbn" value="{{$book->isbn}}">
                <input type="hidden" name="titolo" value="{{$book->titolo}}">
                <input type="hidden" name="autore" value="{{$book->autore}}">
                <input type="hidden" name="prezzo" value="{{$book->prezzo}}">
                <input type="submit" name="action" value="Modifica">
                <input type="submit" name="action" value="Rimuovi">
            </form>
        @endforeach
        
        <br><a href='/'><button>Torna alla home</button></a>

    </body>
</html>

