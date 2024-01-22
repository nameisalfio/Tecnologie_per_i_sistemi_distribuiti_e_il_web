<html>
    <body>
        <h2>Clients</h2>

        <p>ID: {{$c->id}}</p>
        <p>Name: {{$c->name}}</p>
        <p>Lastname: {{$c->lastname}}</p>
        <p>Age: {{$c->age}}</p>
        <br>
        <form action="{{route('clients.destroy', $c->id)}}" method="POST">
            @csrf 
            @method("DELETE")
            <button>Delete</button>
        </form>

        <a href="{{route('clients.index')}}"><button>Back to home</button></a>
    </body>
</html>