<html>
    <head>
        <title>Show</title>
    </head>
    <body>
        <h2>Show</h2>
        <p>ID: {{$o->id}}</p>
        <p>Name: {{$o->name}}</p>
        <p>Lastname: {{$o->lastname}}</p>
        <p>Age: {{$o->age}}</p>
        <p>City: {{$o->city}}</p>
        <br>
        <form action="{{route('owners.destroy', $o)}}" method="POST">
            @csrf
            @method("DELETE")
            <button>Delete</button>
        </form>
        <br><a href="{{route('owners.index')}}"><button>Back to home</button></a>
    </body>
</html>