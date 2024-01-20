<html>
    <body>
        <h2>Students</h2>
         
        <form action="{{route('students.store')}}" method="POST">
            @csrf 
            
            Name:<input type="text" name="name" required>
            Last name:<input type="text" name="lastname" required>
            Age:<input type="text" name="age" required>
            <button>Create now</button>
        </form>

        <br><a href="{{route('students.index')}}"><button>Back to Homepage</button></a>
    </body>
</html>