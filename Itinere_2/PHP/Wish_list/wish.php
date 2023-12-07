<head>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Cinema</title>
</head>
<?php 
    $conn = new mysqli("localhost", "root", "root", "Cinema");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $query = "SELECT * FROM wlist";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<p>Film presenti nella tua wishlist: </p><br>";
            while ($rows = $result->fetch_assoc())
                echo "<p>Titolo: ".$rows["titolo"].", regista: ".$rows["regista"]."</p>";
        } else {
            echo "<p>Wish list vuota</p>";
        }
        
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $query = "DELETE FROM wlist";
        $result = $conn->query($query);
        echo "<p>Wish list svuotata</p>";
    }
    
    echo "<a href='index.php'><button>Torna alla home page</button></a>";
    $conn->close();
?>