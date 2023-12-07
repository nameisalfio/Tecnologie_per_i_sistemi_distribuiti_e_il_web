<head>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Cinema</title>
</head>
<?php 
    $conn = new mysqli("localhost", "root", "root", "Cinema");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["choise"])) {

            if ($_POST["choise"] == "Si") {

                $query = "INSERT INTO wlist (titolo, regista) VALUES (?,?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $_POST["titolo"], $_POST["regista"]);
                $stmt->execute();

                echo "<p>Inserito nella wish list</p>";
                $stmt->close();
            }

            else if ($_POST["choise"] == "No") {
                header("Location: index.php");
                exit();
            }

        } else {

            $query = "SELECT * FROM wlist WHERE titolo=? AND regista=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $_POST["titolo"], $_POST["regista"]);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                while ($rows = $result->fetch_assoc())
                    echo "<h1>Film richiesto: ".$rows["titolo"].", regista: ".$rows["regista"]."</h1><br>";

            } else {
                echo "<p>Il film non è presente nella tua wish list<br>Vuoi aggiungerlo?</p>
                <form action='script.php' method='post' >
                <input type='submit' name='choise' value='Si'>
                <input type='submit' name='choise' value='No'>
                <input type='hidden' name='titolo' value='".$_POST['titolo']."'>
                <input type='hidden' name='regista' value='".$_POST['regista']."'>
                </form>";
                
                echo "<br><br>";

                echo "<form action='wish.php' method='get'>
                        <button>Vedi Wish list</button>
                    </form>
                    <br>
                        
                    <form action='wish.php' method='post'>
                        <button>Svuota adesso</button>
                    </form><br>";
            }
            $stmt->close();
        }
        
        echo "<a href='index.php'><button>Torna alla home page</button></a>";
    }

    $conn->close();
?>