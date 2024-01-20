<html>
    <body>
        <h2>Books</h2>

        <ul>
            <li>Title: {{$book->title}}</li>
            <li>Student: {{$book->student}}</li>
            <li>Price: {{$book->price}}</li>
        </ul>
        <br><a href="{{route('books.index')}}"><button>Back to Homepage</button></a>
    </body>
</html>

