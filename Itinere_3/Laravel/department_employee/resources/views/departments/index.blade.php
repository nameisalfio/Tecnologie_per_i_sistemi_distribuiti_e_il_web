<html>
    <body>
        <h2>Index</h2>
        @foreach($departments as $d)
        <form>
            <p>Name: {{$d->name}}</>
            <button formaction="{{route('departments.show', $d)}}">Show</button>
            <button formaction="{{route('departments.edit', $d)}}">Edit</button>
        </form>
        @endforeach
        <br>
        <form action="{{route('departments.create')}}">
            <button>Create new deparment</button>
        </form>
        <br><a href="/"><button>Back at Welcome</button></a>
    </body>
</html>