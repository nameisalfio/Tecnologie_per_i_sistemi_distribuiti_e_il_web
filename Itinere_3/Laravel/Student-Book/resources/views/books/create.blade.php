<html>
    <body>
        <h2>Books</h2>
         
        <form action="{{route('books.store')}}" method="POST">
            @csrf 
            
            Title:<input type="text" name="title" required>
            Student:<select name="student" required>
                @foreach($students as $s)
                <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
            </select>
            Price:<input type="text" name="price" required>
            <button>Create now</button>
        </form>

        <br><a href="{{route('books.index')}}"><button>Back to Homepage</button></a>
    </body>
</html>