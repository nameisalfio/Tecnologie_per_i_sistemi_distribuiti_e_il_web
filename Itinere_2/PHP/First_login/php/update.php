<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <h3>Modifica credenziali</h3>

        <form action="/php/script.php" method="POST">
            <?php
                session_start();
                
                echo "<label for='username'>Username:</label>";
                echo "<input type='text' name='username' value='".$_SESSION["username"]."'><br>";
                echo "<label for='age'>Age:</label>";
                echo "<input type='age' name='age' value='".$_SESSION["age"]."'><br>";
                echo "<label for='email'>Email:</label>";
                echo "<input type='email' name='email' value='".$_SESSION["email"]."'><br>";
                echo "<button id='green'>Update</button>";
                echo "<input type='hidden' name='action' value='update'>";
                echo "<input type='hidden' name='id' value='".$_SESSION["id"]."'>";
            ?>  
        </form>

        <br><a href="../index.html"><button id="green">Torna alla homepage</button></a>
    </body>
</html>
