<html>
    <body>
        <h2>Edit</h2>

        <form action="{{route('regions.update', $r)}}" method="POST">
            @csrf 
            @method("PUT")
            Name: <input name="name" value="{{$r->name}}">
            <button>Edit</button>
        </form>

        <br><a href="{{route('regions.index')}}"><button>Back To Home</button></a>
    </body>
</html>