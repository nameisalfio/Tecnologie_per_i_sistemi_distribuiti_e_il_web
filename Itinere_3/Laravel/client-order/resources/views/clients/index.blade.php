<html>
    <body>
        <h2>Clients</h2>
        
        @foreach($clients as $c)
        <form>
            <p>Name: {{$c->name}}</p>
            <button formaction="{{route('clients.show', $c->id)}}" method="GET">Show</button>
            <button formaction="{{route('clients.edit', $c->id)}}" method="GET">Edit</button>
        </form>
        @endforeach
        <br>
        <form action="{{route('clients.create')}}" method="GET">
            <button>Create new client</button>
        </form>

        <br><a href="../"><button>Back to Welcome</button></a>
    </body>
</html>