<html>
    <body>
        <h2>Clients</h2>

        <form action="{{route('clients.update', $c->id)}}" method="POST">
            @csrf
            @method("PUT")
            
            <p>Name:<input name="name" value="{{$c->name}}"></p>
            <p>Lastname:<input name="lastname" value="{{$c->lastname}}"></p>
            <p>Age:<input name="age" value="{{$c->age}}"></p><br>
            <button>Update</button>
        </form>

        <a href="{{route('clients.index')}}"><button>Back to home</button></a>
    </body>
</html>