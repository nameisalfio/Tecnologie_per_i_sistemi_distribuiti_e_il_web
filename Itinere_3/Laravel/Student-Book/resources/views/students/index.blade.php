<html>
    <body>
        <h2>Students</h2>

        @foreach($students as $s)
        <form>
            <ul>
                <li>Name: {{$s->name}}</li>
                <li>Last name: {{$s->lastname}}</li>
                <button formaction="{{route('students.show', $s->id)}}" method="GET">Show</button>
                <button formaction="{{route('students.edit', $s->id)}}" method="GET">Edit</button>
            </ul>
        </form>
        @endforeach
        <br>
        <form action="{{route('students.create')}}" method="GET">
            <button>Create new student</button>
        </form>

        <br><a href="/"><button>Back to Welcome</button></a>
    </body>
</html>