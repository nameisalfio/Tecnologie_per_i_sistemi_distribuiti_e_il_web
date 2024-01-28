<html>
    <body>
        <h2>Index</h2>

        @foreach($projects as $p)
        <form>
            Title: {{$p->title}}
            <button formaction="{{route('projects.show', $p->id)}}">Show</button>
            <button formaction="{{route('projects.edit', $p->id)}}">Edit</button>
        </form>
        @endforeach

        <br>
        
        <form action="{{route('projects.create')}}">
            <button>Create new</button>
        </form>

        <a href="/"><button>Back to Welcome</button></a>
    </body>
</html>