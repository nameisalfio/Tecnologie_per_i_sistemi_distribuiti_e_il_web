<html>
    <body>
        <h2>Show</h2>

        <p>ID: {{$c->id}}</p>
        <p>Name: {{$c->name}}</p>
        <p>Job: {{$c->job}}</p>
        <p>Img: <img src="{{$c->img}}" alt="Image not avaible" width="100"></p>
        <p>Price: {{$c->price}}</p>
        <p>Region_id: {{$c->region_id}}</p>

        <br>

        <form action="{{route('costumes.destroy', $c)}}" method="POST">
            @csrf 
            @method("DELETE")
            <button>Delete</button>
        </form>

        <br><a href="{{route('costumes.index')}}"><button>Back To Home</button></a>
    </body>
</html>