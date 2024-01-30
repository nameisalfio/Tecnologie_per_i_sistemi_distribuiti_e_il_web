<html>
    <body>
        <h2>Edit</h2>

        <form action="{{route('continents.update', $c)}}" method="POST">
            @csrf 
            @method("PUT")
            Name: <input name="name" value="{{$c->name}}">
            <button>Update</button>
        </form>
        <br><a href="{{route('continents.index')}}"><button>Back to home</button></a>
    </body>
</html>
