<html>
    <body>
        <h2>Students</h2>

        <ul>
            <li>Name: {{$student->name}}</li>
            <li>Last name: {{$student->lastname}}</li>
            <li>Age: {{$student->age}}</li>
            <li>Books:
                <ul>
                    @foreach($student->books as $b)
                    <li>{{$b->title}}</li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <br><a href="{{route('students.index')}}"><button>Back to Homepage</button></a>
    </body>
</html>

