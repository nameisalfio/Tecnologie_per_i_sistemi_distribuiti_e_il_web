<?php

    function createFilm($conn, $titolo, $anno, $paese, $regista) {
        $query = "INSERT INTO films (titolo, anno, paese, regista) VALUE (?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $titolo, $anno, $paese, $regista);
        $stmt->execute();   

        if ($stmt->affected_rows > 0)
            echo "<p>Film inserito correttamente</p>";
        else   
            echo "<p>Errore nell'inserimento del film</p>";

        $stmt->close();
    }

    function updateFilm($conn, $titolo, $anno, $paese, $regista) {
        $query = "UPDATE films SET anno = ?, paese = ? , regista = ? WHERE titolo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $anno, $paese, $regista, $titolo);
        $stmt->execute();   

        if ($stmt->affected_rows > 0)
            echo "<p>Film aggiornato correttamente</p>";
        else   
            echo "<p>Errore nell'aggiornamento del film</p>";

        $stmt->close();
    }

    function deleteFilm($conn, $titolo) {
        $query = "DELETE FROM films WHERE titolo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $titolo);
        $stmt->execute();   

        if ($stmt->affected_rows > 0)
            echo "<p>Film rimosso correttamente</p>";
        else   
            echo "<p>Errore nella rimozione del film</p>";

        $stmt->close();
    }

    function readAllFilms($conn) {   
        $query = "SELECT * from films";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                echo "<p>Titolo: <a href='redirect.php?titolo=".$rows["titolo"]."'>".$rows["titolo"]."</a>".
                        ", Anno: ".$rows["anno"].
                        ", Paese: ".$rows["paese"].
                        ", Regista: ".$rows["regista"]."</p>";
            }
        } else 
            echo "<p>Non è presente nessun film</p>";
    }

    $conn = new mysqli("localhost", "root", "root", "Cinema");
    if ($conn->connect_error)
        die("Errore: " . $conn->connect_error);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["action"] == "create") {
            createFilm($conn, $_POST["titolo"], $_POST["anno"], $_POST["paese"], $_POST["regista"]);
            echo "<a href='index.html'><button>Vai alla home</button></a>";
        }

        if ($_POST["action"] == "update") {
            updateFilm($conn, $_POST["titolo"], $_POST["anno"], $_POST["paese"], $_POST["regista"]);
            echo "<a href='index.html'><button>Vai alla home</button></a>";
        }

        if ($_POST["action"] == "delete") {
            deleteFilm($conn, $_POST["titolo"]);
            echo "<a href='index.html'><button>Vai alla home</button></a>";
        }

        $conn->close();
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        readAllFilms($conn);
        echo "<a href='index.html'><button>Vai alla home</button></a>";
        $conn->close();
    }

?>