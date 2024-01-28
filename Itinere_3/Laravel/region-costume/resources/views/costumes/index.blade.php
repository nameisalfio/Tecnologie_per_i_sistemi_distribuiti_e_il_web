<html>
    <body>
        <h2>Index</h2>

        @foreach($costumes as $c)
        <form>
            <p>Name: {{$c->name}}</p>
            <button formaction="{{route('costumes.show', $c)}}">Show more</button>
            <button formaction="{{route('costumes.edit', $c)}}">Edit now</button>
        </form>
        @endforeach
        
        <br>

        <h3>Dimezza tutti i prezzi</h3>
        <form action="costumes/Arlecchino" method="POST">
            @csrf 
            <button>Arlecchino</button>
        </form>

        <h3>Raddoppia tutti i prezzi</h3>
        <form action="costumes/Pulcinella" method="POST">
            @csrf 
            <button>Pulcinella</button>
        </form>

        <br>

        <form action="{{route('costumes.create')}}" method="GET">
            <button>Create new</button>
        </form>

        <br><a href="/"><button>Back to Welcome</button></a>
    </body>
</html>