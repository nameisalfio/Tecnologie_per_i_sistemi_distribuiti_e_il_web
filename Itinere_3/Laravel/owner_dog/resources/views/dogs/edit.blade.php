<html>
    <head>
        <title>Edit</title>
    </head>
    <body>
        <h2>Edit</h2>
        <form action="{{route('dogs.update', $o)}}" method="POST">
            @csrf 
            @method("PUT")
            Name: <input name="name" value="$o.name">
            Breed: <input name="breed" value="$o.breed">
            Owner:
            <select name="owner" required>
                @foreach($owners as $o)
                <option value="{{$o->id}}">{{$o->name}}</option>
                @endforeach
            </select>
            <button>Update</button>
        </form>
        <br><a href="{{route('dogs.index')}}"><button>Back to home</button></a>
    </body>
</html>