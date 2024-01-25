<html>
    <body>
        <h2>Show</h2>

        <p>ID: {{$d->id}}</p>
        <p>Name: {{$d->name}}</p>
        <p>Faculty: {{$d->faculty}}</p>
        <p>Location: {{$d->location}}</p>

        <br>
        <form action="{{route('departments.destroy', $d)}}" method="POST">
            @csrf 
            @method("DELETE")
            <button>Delete</button>
        </form>

        <br><a href="{{route('departments.index')}}"><button>Back at Home</button></a>
    </body>
</html>