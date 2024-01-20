<html>
    <body>
        <h2>Students</h2>

        <form action="{{route('students.update', $student->id)}}" method="POST">
            @csrf 
            @method("PUT")
            
            Name:<input type="text" name="name" value="{{$student->name}}">
            Last name:<input type="text" name="lastname" value="{{$student->lastname}}">
            Age:<input type="text" name="age" value="{{$student->age}}">
            <button>Update now</button>
        </form>

        <br>

        <form action="{{route('students.destroy', $student->id)}}" method="POST">
            @csrf
            @method("DELETE")

            <button>Delete</button>
        </form>

        <br><a href="{{route('students.index')}}"><button>Back to Homepage</button></a>
    </body>
</html>

