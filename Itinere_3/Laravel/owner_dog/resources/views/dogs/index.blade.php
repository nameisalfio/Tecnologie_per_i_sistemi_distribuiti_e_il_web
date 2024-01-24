<html>
    <head>
        <title>Index</title>
    </head>
    <body>
        <h2>Index</h2>
        <form>
            @foreach($dogs as $d)
            <p>Name: {{$d->name}}</p>
            <button formaction="{{route('dogs.show', $d)}}" method="GET">Show</button>
            <button formaction="{{route('dogs.edit', $d)}}" method="GET">Edit</button>
            @endforeach
        </form>
        <br>
        <form action="{{route('dogs.create')}}" method="GET">
            <button>Create new dogs</button>
        </form>
        <br><a href="../"><button>Back to Welcome</button></a>
    </body>
</html>