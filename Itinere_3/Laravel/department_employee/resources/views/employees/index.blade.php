<html>
    <body>
        <h2>Index</h2>
        @foreach($employees as $e)
        <form>
            <p>Name: {{$e->name}}</>
            <button formaction="{{route('employees.show', $e)}}">Show</button>
            <button formaction="{{route('employees.edit', $e)}}">Edit</button>
            <button formaction="{{route('employees.increaseSalary', [$e, 20])}}">Increase Salary of 20%</button>

        </form>
        @endforeach
        <br>
        <form action="{{route('employees.create')}}">
            <button>Create new employee</button>
        </form>
        <br><a href="/"><button>Back at Welcome</button></a>
    </body>
</html>