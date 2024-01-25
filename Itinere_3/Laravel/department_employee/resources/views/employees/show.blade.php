<html>
    <body>
        <h2>Show</h2>

        <p>ID: {{$e->id}}</p>
        <p>Name: {{$e->name}}</p>
        <p>Lastname: {{$e->lastname}}</p>
        <p>Salary: {{$e->salary}}</p>
        <p>Department: {{$e->department}}</p>

        <br>
        <form action="{{route('employees.destroy', $e)}}" method="POST">
            @csrf 
            @method("DELETE")
            <button>Delete</button>
        </form>

        <br><a href="{{route('employees.index')}}"><button>Back at Home</button></a>
    </body>
</html>