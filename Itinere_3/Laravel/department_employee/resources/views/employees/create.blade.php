<html>
    <body>
        <h2>Create</h2>
        <form action="{{route('employees.store')}}" method="POST">
            @csrf
            Name:<input name="name" required>
            Lastname:<input name="lastname" required>
            Salary:<input name="salary" required>
            Department:
            <select name="department" required>
                @foreach($departments as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
            </select>
            <button>Create</button>
        </form>
   
        <br><a href="{{route('employees.index')}}"><button>Back at Home</button></a>
    </body>
</html>