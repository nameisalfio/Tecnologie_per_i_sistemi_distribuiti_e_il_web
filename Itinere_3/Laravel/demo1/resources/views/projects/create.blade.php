<html>
    <body>
        <h2>Create</h2>

        <form action="{{route('projects.store')}}" method="POST">
            @csrf
            Title: <input name="title" required>
            Description: <input name="description" required>
            <button>Create now</button>
        </form>

        <a href="{{route('projects.index')}}"><button>Back to home</button></a>
    </body>
</html>