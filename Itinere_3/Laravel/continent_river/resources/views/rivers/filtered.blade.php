<html>
    <body>
        <h2>Index</h2>

        @foreach($rivers as $r)
        <form>
            Name: {{$r->name}}
            <button formaction="{{route('rivers.show', $r)}}">Show</button>
            <button formaction="{{route('rivers.edit', $r)}}">Edit</button>
        </form>
        @endforeach
        <br>
        <form action="{{route('rivers.create')}}" method="GET">
            <button>Create</button>
        </form>
        <br>
        <form action="/rivers/unfilter" method="POST">
            @csrf
            <button>Unfilter</button>
        </form>
        <br><a href="/"><button>Back to Welcome</button></a>
    </body>
</html>