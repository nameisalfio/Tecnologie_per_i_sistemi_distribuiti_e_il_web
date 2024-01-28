<html>
    <body>
        <h2>Show</h2>

        <p>ID: {{$r->id}}</p>
        <p>Name: {{$r->name}}</p>
        <p>Costumes:</p>
        @foreach($r->costumes as $c)
        <ul>
            <li>
                Name: {{$c->name}} - Image: <img src="{{$c->img}}" alt="Image not avaible" width="100">
            </li>
        </ul>
        @endforeach

        <br>

        <form action="{{route('regions.destroy', $r)}}" method="POST">
            @csrf 
            @method("DELETE")
            <button>Delete</button>
        </form>

        <br><a href="{{route('regions.index')}}"><button>Back To Home</button></a>
    </body>
</html>
