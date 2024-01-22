<html>
    <body>
        <h2>Orders</h2>
        
        @foreach($orders as $o)
        <form>
            <p>Object: {{$o->object}}</p>
            <button formaction="{{route('orders.show', $o->id)}}" method="GET">Show</button>
            <button formaction="{{route('orders.edit', $o->id)}}" method="GET">Edit</button>
        </form>
        @endforeach
        <br>
        <form action="{{route('orders.create')}}" method="GET">
            <button>Create new order</button>
        </form>

        <br><a href="../"><button>Back to Welcome</button></a>
    </body>
</html>