<html>
    <body>
        <h2>Show</h2>

        <p>Title: {{$t->title}}</p>
        <p>Description: {{$t->description}}</p>

        <br>

        <form action="{{route('tasks.destroy', $t->id)}}" method="POST">
            @csrf
            @method("DELETE")
            <button>Delete now</button>
        </form>

        <a href="{{route('tasks.index')}}"><button>Back to home</button></a>
    </body>
</html>