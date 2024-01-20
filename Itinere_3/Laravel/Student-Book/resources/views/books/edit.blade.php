<html>
    <body>
        <h2>Books</h2>

        <form action="{{route('books.update', $book->id)}}" method="POST">
            @csrf 
            @method("PUT")
            
            Title:<input type="text" name="title" value="{{$book->title}}">
            <select>
                @foreach($students as $s)
                <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
            </select>
            Price:<input type="text" name="price" value="{{$book->price}}">
            <button>Update now</button>
        </form>

        <br>

        <form action="{{route('books.destroy', $book->id)}}" method="POST">
            @csrf
            @method("DELETE")

            <button>Delete</button>
        </form>

        <br><a href="{{route('books.index')}}"><button>Back to Homepage</button></a>
    </body>
</html>

