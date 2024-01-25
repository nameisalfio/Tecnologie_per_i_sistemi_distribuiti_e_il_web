<html>
    <body>
        <h2>Edit</h2>
        <form action="{{route('employees.update', $e)}}" method="POST">
            @csrf
            @method("PUT")
            Name:<input name="name" value="{{$e->name}}">
            Lastname:<input name="lastname" value="{{$e->lastname}}">
            Salary:<input name="salary" value="{{$e->salary}}">
            Department:
            <select name="department">
                @foreach($departments as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
            </select>
            <button>Update</button>
        </form>    
        <br><a href="{{route('employees.index')}}"><button>Back at Home</button></a>
    </body>
</html>