<html>
    <head>
        <title>Create</title>
    </head>
    <body>
        <h2>Create</h2>
        <form action="{{route('dogs.store')}}" method="POST">
            @csrf
            Name: <input name="name" required>
            Breed: <input name="breed" required>
            Owner: 
            <select name="owner" required>
                @foreach($owners as $o)
                <option value="{{$o->id}}">{{$o->name}}</option>
                @endforeach
            </select>
            <button>Create</button>
        </form>
        <br><a href="{{route('dogs.index')}}"><button>Back to home</button></a>
    </body>
</html>