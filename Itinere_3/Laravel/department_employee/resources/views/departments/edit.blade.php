<html>
    <body>
        <h2>Edit</h2>
        <form action="{{route('departments.update', $d)}}" method="POST">
            @csrf 
            @method("PUT")
            Name: <input name="name" value="{{$d->name}}"><br>
            Faculty: <input name="faculty" value="{{$d->faculty}}"><br>
            Location: <input name="location" value="{{$d->location}}"><br><br>
            <button>Update</button>
        </form>    
        <br><a href="{{route('departments.index')}}"><button>Back at Home</button></a>
    </body>
</html>