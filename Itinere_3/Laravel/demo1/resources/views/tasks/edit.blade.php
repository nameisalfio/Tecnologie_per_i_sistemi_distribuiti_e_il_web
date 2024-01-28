<html>
    <body>
        <h2>Edit</h2>

        <form action="{{route('tasks.update', $t->id)}}" method="POST">
            @csrf
            @method("PUT")
            Title: <input name="title" value="{{$t->title}}">
            Description: <input name="description" value="{{$t->description}}">
            Project: 
            <select name="project" required>
                @foreach($projects as $p)
                <option value="{{$p->id}}">{{$p->title}}</option>
                @endforeach
            </select>
            <button>Update now</button>
        </form>

        <a href="{{route('tasks.index')}}"><button>Back to home</button></a>
    </body>
</html>