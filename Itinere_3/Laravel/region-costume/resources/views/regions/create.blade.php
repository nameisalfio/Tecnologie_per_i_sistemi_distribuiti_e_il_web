<html>
    <body>
        <h2>Create</h2>

        <form action="{{route('regions.store')}}" method="POST">
            @csrf
            Name: <input name="name" required>
            <button>Create</button>
        </form>

        <br><a href="{{route('regions.index')}}"><button>Back To Home</button></a>
    </body>
</html>