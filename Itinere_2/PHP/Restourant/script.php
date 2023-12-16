<?php

    $conn = new mysqli("localhost", "root", "root", "ristorante");

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        
        if (isset($_GET["action"])) {
            
            if ($_GET["action"] === "read_table") {
                $query = "SELECT * FROM tavolo";
                $stmt = $conn->prepare($query);
                $stmt->execute();   
                $res = $stmt->get_result(); 
    
                print("<h2>Tavoli presenti</h2>");
                while ($rows = $res->fetch_assoc()) {
                    $id = $rows["id"];
                    $id_cameriere = $rows["id_cameriere"];
                    $num_posti = $rows["num_posti"];
                    $stato = $rows["stato"];

                    print("<form action='script.php' method='POST'>");
                    print("<p>ID: ".$id.", Cameriere: ".$id_cameriere.", Posti: ".$num_posti.", Stato: ".$stato."</p>");
                    print("<input type='hidden' name='id' value='".$id."'>");

                    if ($stato == "occupato")
                        print("<button type='submit' name='action' value='update_libera'> Libera </button>");
                    else if ($stato == "libero") {
                        print("<label for='id_cameriere'>ID Cameriere: </label>");
                        print("<input type='text' name='id_cameriere'>");
                        print("<button type='submit' name='action' value='update_occupa'> Occupa </button>");
                    }

                    print("</form>");
                }
            }

            if ($_GET["action"] === "read_waiter") {
                $query = "SELECT * FROM cameriere";
                $stmt = $conn->prepare($query);
                $stmt->execute();    
                $res = $stmt->get_result(); 
    
                print("<h2>Camerieri presenti</h2>");
                while ($rows = $res->fetch_assoc()) {
                    $id = $rows["id"];
                    $nome = $rows["nome"];
                    $cognome = $rows["cognome"];
                    $username = $rows["username"];
                    $password = $rows["password"];

                    print("<form action='script.php' method='POST'>");
                    print("<p>ID: ".$id.", Nome: ".$nome.", Cognome: ".$cognome.", Username: ".$username.", Password: ".$password."</p>");
                    print("<input type='hidden' name='id' value='" . $id . "'>");
                    print("<button type='submit' name='action' value='delete'> Elimina </button>");
                    print("</form>");
                }
            }


        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST["action"])) {
            
            if ($_POST["action"] === "create") {
                $query = "INSERT INTO cameriere (nome, cognome, username, password) VALUES (?,?,?,?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssss", $_POST["nome"], $_POST["cognome"], $_POST["username"], $_POST["password"]);
                $stmt->execute();    
                print("<p>Cameriere inserito correttamente</p>");
            }

            if ($_POST["action"] === "update_libera") {
                $query = "UPDATE tavolo SET id_cameriere=null, stato='libero' WHERE id=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $_POST["id"]);
                $stmt->execute();    
                print("<p>Tavolo aggiornato correttamente</p>");
            }

            if ($_POST["action"] === "update_occupa") {
                $query = "UPDATE tavolo SET id_cameriere=?, stato='occupato' WHERE id=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $_POST["id_cameriere"], $_POST["id"]);
                $stmt->execute();    
                print("<p>Tavolo aggiornato correttamente</p>");
            }

            if ($_POST["action"] === "delete") {
                $query = "DELETE FROM cameriere WHERE id=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $_POST["id"]);
                $stmt->execute();    
                print("<p>Cameriere rimosso correttamente</p>");
            }
        }
    }

    print("<a href='index.html'><button>Torna alla homepage</button></a>");
?>
