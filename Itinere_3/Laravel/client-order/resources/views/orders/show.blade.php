<html>
    <body>
        <h2>Order</h2>

        <p>ID: {{$o->id}}</p>
        <p>Object: {{$o->object}}</p>
        <p>Client: {{$o->client_id}}</p>
        <br>
        <form action="{{route('orders.destroy', $o->id)}}" method="POST">
            @csrf 
            @method("DELETE")
            <button>Delete</button>
        </form>

        <a href="{{route('orders.index')}}"><button>Back to home</button></a>
    </body>
</html>