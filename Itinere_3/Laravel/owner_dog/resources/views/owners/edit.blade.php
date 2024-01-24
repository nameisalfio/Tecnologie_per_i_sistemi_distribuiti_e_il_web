<html>
    <head>
        <title>Edit</title>
    </head>
    <body>
        <h2>Edit</h2>
        <form action="{{route('owners.update', $o)}}" method="POST">
            @csrf
            @method("PUT")
            Name: <input name="name" value="{{$o->name}}">
            Lastname: <input name="lastname" value="{{$o->lastname}}">
            Age: <input name="age" value="{{$o->age}}">
            City: <input name="city" value="{{$o->city}}">
            <button>Update</button>
        </form>
        <br><a href="{{route('owners.index')}}"><button>Back to home</button></a>
    </body>
</html>