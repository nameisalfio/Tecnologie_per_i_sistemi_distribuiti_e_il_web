<html>
    <body>
        <h2>Index</h2>

        <form action="{{route('continents.store')}}" method="POST">
            @csrf
            Name: <input name="name" required>
            <button>Create</button>
        </form>
        <br><a href="{{route('continents.index')}}"><button>Back to home</button></a>
    </body>
</html>
