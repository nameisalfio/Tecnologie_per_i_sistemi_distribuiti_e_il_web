<?php
    $conn = new mysqli("localhost", "root", "root", "Biblioteca");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if ($_POST["action"] === "Inserisci") {
            $isbn = $_POST["isbn"];
            $title = $_POST["title"];
            $author = $_POST["author"];
            $publisher = $_POST["publisher"];
            $country = $_POST["country"];
            $price = $_POST["price"];

            $query = "INSERT INTO books2 (isbn, title, author, publisher, country, price) VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssss", $isbn, $title, $author, $publisher, $country, $price);
            $stmt->execute();

            print("<p>Record inserito con successo</p>");
        }

        if ($_POST["action"] === "Incrementa") {
            $query1 = "UPDATE books2 SET price = price + price * 0.1 WHERE country = 105";
            $query2 = "UPDATE books2 SET price = price + price * 0.2 WHERE country <> 105";

            $stmt = $conn->prepare($query1);
            $stmt->execute();

            $stmt = $conn->prepare($query2);
            $stmt->execute();

            print("<p>Records aggiornati con successo</p>");
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "GET") {

        if ($_GET["action"] === "Ricerca") {
            $author = $_GET["author"];
            $query = "SELECT * FROM books2 WHERE author=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $author);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                print("<h2>Risultato trovato:</h2>");
                while ($rows = $res->fetch_assoc()) {
                    $id = $rows["id"];
                    $isbn = $rows["isbn"];
                    $title = $rows["title"];
                    $author = $rows["author"];
                    $publisher = $rows["publisher"];
                    $country = $rows["country"];
                    $price = $rows["price"];
                    print("<p>ID: ".$id." | ISBN: ".$isbn." | Title: ".$title." | Author: ".$author." | Publisher: ".$publisher." | Country: ".$country." | Price: ".$price."</p>");
                }
            } else {
                print("<h2>Nessun risultato trovato:</h2>");
            }

            print("<form action='script.php' method='POST'>");
            print("<input type='submit' name='action' value='Incrementa'>");
            print("</form>");
        }
    }

    print("<a href='index.php'><button>Torna alla homepage</button></a>");
    $conn->close();
?>