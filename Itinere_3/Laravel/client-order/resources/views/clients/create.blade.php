<html>
    <body>
        <h2>Clients</h2>

        <form action="{{route('clients.store')}}" method="POST">
            @csrf
            
            Name:<input name="name" required><br>
            Lastname:<input name="lastname" required><br>
            Age:<input name="age" required><br><br>
            <button>Create</button>
        </form>

        <br><a href="{{route('clients.index')}}"><button>Back to home</button></a>
    </body>
</html>