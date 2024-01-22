<html>
    <body>
        <h2>Orders</h2>

        <form action="{{route('orders.store')}}" method="POST">
            @csrf
            
            Object:<input name="object" required><br>
            Client:
            <select name="client_id" required>
                @foreach($clients as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select><br><br>
            <button>Create</button>
        </form>

        <br><a href="{{route('orders.index')}}"><button>Back to home</button></a>
    </body>
</html>