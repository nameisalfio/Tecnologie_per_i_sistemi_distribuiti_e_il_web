<html>
    <body>
        <h2>Index</h2>

        <form action="{{route('rivers.store')}}" method="POST">
            @csrf
            Name: <input name="name" required>
            Length: <input name="length" required>
            Continent:
            <select name="continent_id">
                @foreach($continents as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
            <button>Create</button>
        </form>
        <br><a href="{{route('rivers.index')}}"><button>Back to home</button></a>
    </body>
</html>
