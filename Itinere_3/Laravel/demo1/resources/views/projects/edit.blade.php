<html>
    <body>
        <h2>Edit</h2>

        <form action="{{route('projects.update')}}" method="POST">
            @csrf
            @method("PUT")
            Title: <input name="title" value="{{$p->title}}">
            Description: <input name="description" value="{{$p->description}}">
            <button>Update now</button>
        </form>

        <a href="{{route('projects.index')}}"><button>Back to home</button></a>
    </body>
</html>