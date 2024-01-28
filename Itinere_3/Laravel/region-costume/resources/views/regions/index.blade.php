<html>
    <body>
        <h2>Index</h2>

        @foreach($regions as $r)
        <form>
            <p>Name: {{$r->name}}</p>
            <button formaction="{{route('regions.show', $r)}}">Show more</button>
            <button formaction="{{route('regions.edit', $r)}}">Edit now</button>
        </form>
        @endforeach

        <br>

        <form action="{{route('regions.create')}}" method="GET">
            <button>Create new</button>
        </form>

        <br><a href="/"><button>Back to Welcome</button></a>
    </body>
</html>