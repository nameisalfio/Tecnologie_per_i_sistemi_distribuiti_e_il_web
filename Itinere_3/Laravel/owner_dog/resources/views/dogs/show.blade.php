<html>
    <head>
        <title>Show</title>
    </head>
    <body>
        <h2>Show</h2>
        <p>ID: {{$d->id}}</p>
        <p>Name: {{$d->name}}</p>
        <p>Breed: {{$d->breed}}</p>
        <p>Owner: {{$d->owner}}</p>
        <br>
        <form action="{{route('dogs.destroy', $d)}}" method="POST">
            @csrf 
            @method("DELETE")
            <button>Delete</button>
        </form>
        <br><a href="{{route('dogs.index')}}"><button>Back to home</button></a>
    </body>
</html>