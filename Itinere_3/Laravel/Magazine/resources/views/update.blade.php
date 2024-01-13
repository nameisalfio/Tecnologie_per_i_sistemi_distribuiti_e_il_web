<html>
    <body>
        <h3>Magazine</h3>

        <form action="/update" method="POST">
            @csrf
            @method('PUT')
            
            Nome: <input type="text" name="nome_prodotto" value="{{$_GET['nome_prodotto']}}"><br>
            Giacenza: <input type="text" name="giacenza" value="{{$_GET['giacenza']}}"><br>
            Prezzo: <input type="text" name="prezzo" value="{{$_GET['prezzo']}}"><br><br>
            
            <button type="submit">Salva Modifiche</button>
            <input type="hidden" name="id" value="{{$_GET['id']}}">
        </form>

        <br><a href='/'><button>Torna alla home</button></a>
    </body>
</html>
