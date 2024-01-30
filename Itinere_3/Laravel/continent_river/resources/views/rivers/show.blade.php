<html>
    <body>
        <h2>Show</h2>

        ID: {{$r->id}}<br>
        Name: {{$r->name}}<br>
        Length: {{$r->length}} km<br>
        Continent_id: {{$r->continent_id}}<br>
        <br>
        <form action="{{route('rivers.destroy', $r)}}" method="POST">
            @csrf 
            @method("DELETE")
            <button>Delete</button>
        </form>
        <br><a href="{{route('rivers.index')}}"><button>Back to home</button></a>
    </body>
</html>
