<html>
    <body>
        <h2>Index</h2>

        @foreach($continents as $c)
        <form>
            Name: {{$c->name}}
            <button formaction="{{route('continents.show', $c)}}">Show</button>
            <button formaction="{{route('continents.edit', $c)}}">Edit</button>
        </form>
        @endforeach
        <br>
        <form action="{{route('continents.create')}}" method="GET">
            <button>Create</button>
        </form>
        <br><a href="/"><button>Back to Welcome</button></a>
    </body>
</html>