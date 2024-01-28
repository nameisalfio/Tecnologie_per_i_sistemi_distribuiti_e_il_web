<html>
    <body>
        <h2>Edit</h2>

        <form action="{{route('costumes.update', $c)}}" method="POST">
            @csrf 
            @method("PUT")
            Name: <input name="name" value="{{$c->name}}">
            Job: <input name="job" value="{{$c->job}}">
            Img: <input name="img" value="{{$c->img}}">
            Price: <input name="price" value="{{$c->price}}">
            Region_id: 
            <select name="region_id">
                @foreach($regions as $r)
                <option value="{{$r->id}}">{{$r->name}}</option>
                @endforeach
            </select>
            <button>Edit</button>
        </form>

        <br><a href="{{route('costumes.index')}}"><button>Back To Home</button></a>
    </body>
</html>