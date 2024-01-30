<html>
    <body>
        <h2>Edit</h2>

        <form action="{{route('rivers.update', $r)}}" method="POST">
            @csrf 
            @method("PUT")
            Name: <input name="name" value="{{$r->name}}"><br>
            Length: <input name="length" value="{{$r->length}}"><br>
            Continent:
            <select name="continent_id">
                @foreach($continents as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select><br>
            <button>Update</button>
        </form>
        <br><a href="{{route('rivers.index')}}"><button>Back to home</button></a>
    </body>
</html>
