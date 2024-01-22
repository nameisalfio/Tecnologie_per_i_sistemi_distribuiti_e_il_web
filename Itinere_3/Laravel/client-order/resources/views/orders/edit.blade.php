<html>
    <body>
        <h2>Order</h2>

        <form action="{{route('orders.update', $o->id)}}" method="POST">
            @csrf
            @method("PUT")
            
            Object:<input name="name" value="{{$o->name}}"><br>
            Client:
            <select name="client_id">
                @foreach($clients as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select><br>
            <button>Update</button>
        </form>

        <a href="{{route('orders.index')}}"><button>Back to home</button></a>
    </body>
</html>