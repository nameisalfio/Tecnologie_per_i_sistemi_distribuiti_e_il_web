<html>
    <body>
        <h2>Index</h2>

        @foreach($tasks as $t)
        <form>
            Title: {{$t->title}}
            <button formaction="{{route('tasks.show', $t->id)}}">Show</button>
            <button formaction="{{route('tasks.edit', $t->id)}}">Edit</button>
        </form>
        @endforeach

        <br>
        
        <form action="{{route('tasks.create')}}">
            <button>Create new</button>
        </form>

        <a href="/"><button>Back to Welcome</button></a>
    </body>
</html>