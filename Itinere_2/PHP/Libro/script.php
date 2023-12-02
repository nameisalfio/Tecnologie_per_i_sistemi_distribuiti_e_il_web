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
    // Inserimento di un libro
    if ($_POST["action"] === "create") 
    {
        $title = $_POST["title"];
        $amount = $_POST["amount"];

        $query = "INSERT INTO store (title, amount) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $title, $amount);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
            echo "Libro " . $title . " inserito correttamente";
        else 
            echo "Errore nell'inserimento del libro " . $title;

        $stmt->close();
    }

    // Ricerca di un libro per titolo
    if ($_POST["action"] === "read") 
    {
        $title = $_POST["title"];

        $query = "SELECT * FROM store WHERE title = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $title);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) 
        {
            echo "<h2>Risultato della ricerca:</h2>";
            while ($row = $result->fetch_assoc()) 
                echo "<p>Titolo: " . $row["title"] . ", Quantità: " . $row["amount"] . "</p>";
        }
        else 
            echo "<p>Nessun libro trovato con il titolo " . $title . ".</p>";

        $stmt->close();
    }

    // Aggiornamento di un libro
    if ($_POST["action"] === "update") 
    {
        $title = $_POST["title"];
        $amount = $_POST["amount"];

        $query = "UPDATE store SET amount = ? WHERE title = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $amount, $title);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
            echo "Quantità del libro " . $title . " aggiornata";
        else 
            echo "Aggiornamento del libro " . $title . " non riuscito";

        $stmt->close();
    }

    // Cancellazione di un libro
    if ($_POST["action"] === "delete") 
    {
        $title = $_POST["title"];

        $query = "DELETE FROM store WHERE title = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $title);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
            echo "Libro rimosso correttamente";
        else 
            echo "Rimozione Libro non riuscita";

        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
    // Visualizzazione dell'intero database
    if ($_GET["action"] === "show") 
    {
        $query = "SELECT * FROM store";
        $result = $conn->query($query);
        if ($result->num_rows > 0) 
        {
            echo "<h2>Libri nella biblioteca:</h2>";
            while ($row = $result->fetch_assoc()) 
                echo "<p>Titolo: " . $row["title"] . ", Quantità: " . $row["amount"] . "</p>";
        }
        else
            echo "<p>Nessun libro trovato nella biblioteca.</p>";
    }
}

$conn->close();
?>
