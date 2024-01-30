<html>
    <body>
        <h2>Show</h2>

        ID: {{$c->id}}<br>
        Name: {{$c->name}}
        <br>
        <form action="{{route('continents.destroy', $c)}}" method="POST">
            @csrf 
            @method("DELETE")
            <button>Delete</button>
        </form>
        <br><a href="{{route('continents.index')}}"><button>Back to home</button></a>
    </body>
</html>
