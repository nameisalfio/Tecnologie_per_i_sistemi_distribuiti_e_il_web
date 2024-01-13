<html>
    <body>
        <h2>Films</h2>

        <form action="/update" method="POST">
            @csrf 
            @method('PUT')

            Titolo:<input type="text" name="titolo" value="{{$_GET['titolo']}}"><br>
            Anno:<input type="text" name="anno" value="{{$_GET['anno']}}"><br>
            Paese:<input type="text" name="paese" value="{{$_GET['paese']}}"><br>
            Regista:<input type="text" name="regista" value="{{$_GET['regista']}}"><br>
            <button>Salva modifiche</button>
            <input type="hidden" name="id" value="{{$_GET['id']}}">
        </form>

        <br><a href="/"><button>Torna alla homepage</button></a>
    </body>
</html>