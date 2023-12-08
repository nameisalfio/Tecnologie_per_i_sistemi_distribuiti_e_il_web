<?php

    $conn = new mysqli("localhost", "root", "root", "University");
    if ($conn->connect_error)
        die("Errore ".$conn->connect_error);

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $query = "SELECT * FROM courses";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo ("<h3>Corsi presenti:</h3>");
            while ($rows = $result->fetch_assoc()) {
                $codice = $rows["codice_corso"];
                $nome = $rows["nome_corso"];
                $descrizione = $rows["descrizione"];
                $crediti = $rows["crediti"];

                print("<p>Codice: <a href='redirect.php?nome=".$nome."'>".$codice."</a>, Nome: ".$nome.", CFU: ".$crediti.", Descrizione: ".$descrizione."</p>");
            }
        } else {
            echo ("<h3>Non ci sono corsi presenti:</h3>");
        }

        print("<a href='/index.html'><button>Torna alla home page</button></a>");
        $stmt->close();
    }
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST["action"])) {
            
            if ($_POST["action"] == "create") {

                $nome = $_POST["nome"];
                $descrizione = $_POST["descrizione"];
                $crediti = $_POST["crediti"];

                $query = "INSERT INTO courses (nome_corso, descrizione, crediti) VALUES (?,?,?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sss", $nome, $descrizione, $crediti);
                $stmt->execute();

                print("<h3>Corso di ".$nome." inserito con successo</h3><br>");
            }
            
            else if ($_POST["action"] == "update") {
                $nome = $_POST["nome"];
                $descrizione = $_POST["descrizione"];
                $crediti = $_POST["crediti"];
                
                $query = "UPDATE courses SET descrizione=?, crediti=? WHERE nome_corso=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sss", $descrizione, $crediti, $nome);
                $stmt->execute();

                print("<h3>Corso di ".$nome." aggiornato con successo</h3><br>");
            }
            
            else if ($_POST["action"] == "delete") {
                $nome = $_POST["nome"];
                
                $query = "DELETE FROM courses WHERE nome_corso=(?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $nome);
                $stmt->execute();

                print("<h3>Corso di ".$nome." rimosso con successo</h3><br>");
            }
        }
        
        print("<a href='/index.html'><button>Torna alla home page</button></a>");
        $stmt->close();
    }

    $conn->close();
?>