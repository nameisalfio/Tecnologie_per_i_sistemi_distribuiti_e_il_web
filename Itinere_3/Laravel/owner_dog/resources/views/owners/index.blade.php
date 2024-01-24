<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        <h2>Index</h2>
        <form>
            @foreach($owners as $o)
            <p>Name: {{$o->name}}</p>
            <button formaction="{{route('owners.show', $o->id)}}" method="GET">Show</button>
            <button formaction="{{route('owners.edit', $o->id)}}" method="GET">Edit</button>
            @endforeach
        </form>
        <br>
        <form action="{{route('owners.create')}}" method="GET">
            <button>Create new owners</button>
        </form>
        <br><a href="../"><button>Back to Welcome</button></a>
    </body>
</html>