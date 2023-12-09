<?php 
    $conn = new mysqli("localhost", "root", "root", "University");
    if ($conn->connect_error)
        die($conn->connect_error);

    print("<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\">");

    if ($_SERVER["REQUEST_METHOD"] === "GET") {

        $corso_ = $_GET["corso"];
        $nome = $_GET["nome"];
        $matricola = $_GET["matricola"];
    
        $query = "SELECT * FROM courses WHERE codice_corso=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $corso_);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            print("<h2>Studente ".$nome." :</h2>");
            while ($rows = $res->fetch_assoc()) {
                print("<p>Codice corso: ".$rows["codice_corso"].
                          ", descrizione: ".$rows["descrizione"].
                          ", crediti: ".$rows["crediti"]."</p>");
            }
        } else {
            print("<p>Nessun corso di laurea assocciato allo studente ".$nome."</p>");
        }
    
        $corso = getNomeCorso($conn, $corso_);
    
        print("<br><h3>Cambia corso di laurea</h3>".
                    "<form action='script.php' method='POST'>".
                        "<label for='corso'>Corso di laurea: </label>".
                        "<input type='text' id='corso' name='corso'><br><br>".
                        "<button type='submit'>Aggiorna corso</button>".
                        "<input type='hidden' name='action' value='update'>".
                        "<input type='hidden' name='matricola' value='".$matricola."'>".
                        "<input type='hidden' name='corso' value='".$corso."'>".
                   "</form><br>");
    
        print("<br><h3>Rimuovi studente ".$nome."</h3>".
        "<form action='script.php' method='POST'>".
            "<button type='submit'>Rimuovi studente</button>".
            "<input type='hidden' name='action' value='delete'>".
            "<input type='hidden' name='matricola' value='".$matricola."'>".
        "</form><br>");
    
        print("<a href='/index.php'><button>Torna alla home page</button></a>");
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        if (isset($_POST["action"])) {
        
            if ($_POST["action"] == "create") {

                $nome = $_POST["nome"];
                $cognome = $_POST["cognome"];
                $corso = getIdCorso($conn, $_POST["corso"]);

                if (!strpos($corso, "Errore!")) { 

                    $query = "INSERT INTO students (nome, cognome, corso_di_laurea) VALUES (?,?,?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sss", $nome, $cognome, $corso);
                    $stmt->execute();

                    print("<h3>Studente ".$nome." inserito con successo</h3>");
                } else {
                    print("<h3>".$corso."</h3>");
                }
            }

            if ($_POST["action"] == "update") {
                $matricola = $_POST["matricola"];
                $corso = getIdCorso($conn, $_POST["corso"]);

                $query = "UPDATE students SET corso_di_laurea=? WHERE matricola=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $corso, $matricola);
                $stmt->execute();

                print("<h3>Corso di laurea aggiornato con successo</h3>");
            }

            if ($_POST["action"] == "delete") {
                $matricola = $_POST["matricola"];

                $query = "DELETE FROM students WHERE matricola = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $matricola);
                $stmt->execute();

                print("<h3>Studente rimosso con successo</h3>");
            }
        }
        print("<a href='/index.php'><button>Torna alla home page</button></a>");

    }

    function getNomeCorso($conn, $id) {
        $query = "SELECT nome_corso FROM courses WHERE codice_corso=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $res = $stmt->get_result(); 

        if ($res->num_rows > 0) {
            $rows = $res->fetch_assoc();
            return $rows["nome_corso"];
        }

        return "Errore! Corso di laurea non disponibile";
    }

    function getIdCorso($conn, $nome) {
        $query = "SELECT codice_corso FROM courses WHERE nome_corso=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $res = $stmt->get_result(); 

        if ($res->num_rows > 0) {
            $rows = $res->fetch_assoc();
            return $rows["codice_corso"];
        }

        return "Errore! Corso di laurea non disponibile";
    }

    $conn->close();

?>
