<html>
    <body>
        <h2>Create</h2>

        <form action="{{route('costumes.store')}}" method="POST">
            @csrf
            Name: <input name="name" required>
            Job: <input name="job" required>
            Img: <input name="img" required>
            Price: <input name="price" required>
            Region_id: 
            <select name="region_id" required>
                @foreach($regions as $r)
                <option value="{{$r->id}}">{{$r->name}}</option>
                @endforeach
            </select>
            <button>Create</button>
        </form>

        <br><a href="{{route('costumes.index')}}"><button>Back To Home</button></a>
    </body>
</html>