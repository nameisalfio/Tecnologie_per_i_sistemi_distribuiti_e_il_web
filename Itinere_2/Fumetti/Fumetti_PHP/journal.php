<?php 
    $conn = new mysqli("localhost", "root", "root", "journal");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if ($_POST["action"] === "Correggi") {
            $id = $_POST["id"];
            $autore = $_POST["autore"];
            $fields = explode("-", $autore);

            $query = "UPDATE fumetti SET autore_nome=?, autore_cognome=? WHERE id=?"; 
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $fields[0], $fields[1], $id);
            $stmt->execute();
            print("<p>Autore aggiornato correttamente</p>");
            $stmt->close();
        }

        if ($_POST["action"] === "Rimuovi") {
            $id = $_POST["id"];    
            $query = "DELETE FROM fumetti WHERE id=?"; 
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $id);

            $stmt->execute();
            print("<p>Fumetto rimosso correttamente</p>");
            $stmt->close();
        }
    }

    print("<a href='index.php'><button>Torna alla homepage</button></a>");
    $conn->close();
?>