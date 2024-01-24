<html>
    <head>
        <title>Create</title>
    </head>
    <body>
        <h2>Create</h2>
        <form action="{{route('owners.store')}}" method="POST">
            @csrf
            Name: <input name="name" required>
            Lastname: <input name="lastname" required>
            Age: <input name="age" required>
            City: <input name="city" required>
            <button>Create</button>
        </form>
        <br><a href="{{route('owners.index')}}"><button>Back to home</button></a>
    </body>
</html>