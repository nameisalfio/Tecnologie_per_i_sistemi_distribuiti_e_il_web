<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
</html>

<?php

$hostname = "localhost";
$username_db = "root";
$password_db = "root";
$name_db = "Biblioteca";

$conn = new mysqli($hostname, $username_db, $password_db, $name_db);
if ($conn->connect_error) 
    die("Connessione fallita: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if ($_POST["action"] === "create") 
    {
        $titolo = $_POST["titolo"];
        $autore = $_POST["autore"];
        $prezzo = $_POST["prezzo"];

        $query = "INSERT INTO books (titolo, autore, prezzo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $titolo, $autore, $prezzo);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
            echo "<p>Libro " . $titolo . " inserito correttamente</p>";
        else 
            echo "<p>Errore nell'inserimento del libro " . $titolo . "</p>";

        $stmt->close();
    }

    if ($_POST["action"] === "update") 
    {
        $titolo = $_POST["titolo"];
        $autore = $_POST["autore"];
        $prezzo = $_POST["prezzo"];

        $query = "UPDATE books SET autore = ?, prezzo = ? WHERE titolo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $autore, $prezzo, $titolo);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
            echo "<p>Libro " . $titolo . " aggiornato</p>";
        else 
            echo "<p>Aggiornamento del libro " . $titolo . " non riuscito</p>";

        $stmt->close();
    }

    if ($_POST["action"] === "delete") 
    {
        $titolo = $_POST["titolo"];

        $query = "DELETE FROM books WHERE titolo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $titolo);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
            echo "<p>Libro " . $titolo . " rimosso correttamente</p>";
        else 
            echo "<p>Rimozione Libro  " . $titolo . " non riuscita</p>";

        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
    if ($_GET["action"] === "read") 
    {
        $query = "SELECT * FROM books";
        $result = $conn->query($query);
        if ($result->num_rows > 0) 
        {
            echo "<h2>Libri presenti:</h2>";
            while ($row = $result->fetch_assoc()) 
            {
                $titolo = $row["titolo"];
                echo "<p>ISBN <a href='redirect.php?titolo=$titolo'>" . $row["isbn"] . "</a>: " . $row["titolo"] . ", Autore: " . $row["autore"] . ", Prezzo: " . $row["prezzo"] . "</p>";
            }
        }
        else
            echo "<p>Nessun libro trovato nella biblioteca.</p>";
    }
}

echo '<a href="index.html"><button type="button">Torna alla homepage</button></a>';
$conn->close();
?>
