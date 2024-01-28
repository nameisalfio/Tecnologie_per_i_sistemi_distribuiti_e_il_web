<html>
    <body>
        <h2>Show</h2>

        <p>Title: {{$p->title}}</p>
        <p>Description: {{$p->description}}</p>
        @if($p->tasks->count() > 0)
        <p>Tasks:</p>
            <ul>
                @foreach($p->tasks as $t)
                <li>ID: {{$t->id}} - Title: {{$t->title}} - Project: {{$t->project}}</li>
                @endforeach
            </ul>
        @endif
        <br>

        <form action="{{route('projects.destroy', $p->id)}}" method="POST">
            @csrf
            @method("DELETE")
            <button>Delete now</button>
        </form>
        
        <a href="{{route('projects.index')}}"><button>Back to home</button></a>
    </body>
</html>