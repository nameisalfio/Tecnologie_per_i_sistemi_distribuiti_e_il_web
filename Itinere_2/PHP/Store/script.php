<?php

    $conn = new mysqli("localhost", "root", "root", "Magazine");

    print("<link rel='stylesheet' href='css/style.css'>");

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $query = "SELECT * FROM prodotti WHERE giacenza > 0";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
    
        if ($res->num_rows > 0) {
            print("<h3>Magazzino:</h3>");
            while($rows = $res->fetch_assoc()) {
                print("<form action='script.php' method='POST'>");
                print("<p>Nome: " . $rows["nome_prodotto"]. ", giacenza: " . $rows["giacenza"]. ", prezzo: " . $rows["prezzo"].
                        "<input type='hidden' name='id' value='" . $rows["id"]. "'>" .
                        "<input type='number' name='amount'>".
                        "<button name='action' value='update'>Compra</button>" .
                        "<button name='action' value='delete'>Rimuovi</button></p>");
                print("</form>");           
            } 
        } else {
            print("<h3>Magazzino vuoto</h3>");
        }
        $stmt->close();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["action"])) {
        
            if ($_POST["action"] == "create") {
                $query = "INSERT INTO prodotti (nome_prodotto, giacenza, prezzo) VALUES (?,?,?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sss", $_POST["nome"], $_POST["giacenza"], $_POST["prezzo"]);
                $stmt->execute();
                print("<p>Prodotto inserito con successo</p>");
            }
        
            if ($_POST["action"] == "update") {
                $query = "UPDATE prodotti SET giacenza=giacenza-? WHERE id=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $_POST["amount"], $_POST["id"]);
                $stmt->execute();
                print("<p>Prodotto acquistato con successo</p>");
            }
        
            if ($_POST["action"] == "delete") {
                $query = "DELETE FROM prodotti WHERE id=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $_POST["id"]);
                $stmt->execute();
                print("<p>Prodotto rimosso con successo dal magazzino</p>");
            }
        }
        $stmt->close();
    }

    print("<a href='index.html'><button>Torna alla home</button></a>");

    $conn->close();
?>
