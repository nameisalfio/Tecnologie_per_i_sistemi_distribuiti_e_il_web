<html>
    <body>
        <h2>Books</h2>

        @foreach($books as $b)
        <form>
            <ul>
                <li>Title: {{$b->title}}</li>
                <button formaction="{{route('books.show', $b->id)}}" method="GET">Show</button>
                <button formaction="{{route('books.edit', $b->id)}}" method="GET">Edit</button>
            </ul>
        </form>
        @endforeach
        <br>
        <form action="{{route('books.create')}}" method="GET">
            <button>Create new book</button>
        </form>

        <br><a href="/"><button>Back to Welcome</button></a>
    </body>
</html>