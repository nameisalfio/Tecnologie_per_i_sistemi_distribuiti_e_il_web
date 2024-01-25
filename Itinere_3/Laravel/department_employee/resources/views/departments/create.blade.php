<html>
    <body>
        <h2>Create</h2>
        <form action="{{route('departments.store')}}" method="POST">
            @csrf
            Name:<input name="name" required>
            Faculty:<input name="faculty" required>
            Location:<input name="location" required>
            <button>Create</button>
        </form>
   
        <br><a href="{{route('departments.index')}}"><button>Back at Home</button></a>
    </body>
</html>