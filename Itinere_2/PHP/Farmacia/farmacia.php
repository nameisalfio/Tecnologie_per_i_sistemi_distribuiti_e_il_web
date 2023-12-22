<?php 
    $conn = new mysqli("localhost", "root", "root", "Farmacia");

    print("<link rel='stylesheet' type='text/css' href='./css/style.css'>");
    
    if ($_SERVER["REQUEST_METHOD"] === "GET") {

       if ($_GET["action"] === "Ricerca") {

            $query="";

            if ($_GET["Principio_Attivo"] === "Vedi tutti")
                $query = "SELECT * FROM Medicinali";
            else
                $query = "SELECT * FROM Medicinali WHERE Principio_Attivo = '".$_GET["Principio_Attivo"]."'";

            $stmt = $conn->prepare($query);
            $stmt->execute();
            $res = $stmt->get_result();
            
            print("<h2>Medicinali trovati:</h2>");
            while($rows = $res->fetch_assoc()) {
                $id = $rows["ID"];
                $Nome_Medicinale = $rows["Nome_Medicinale"];
                $Principio_Attivo = $rows["Principio_Attivo"];
                $Forma_Farmaceutica = $rows["Forma_Farmaceutica"];
                $Dosaggio = $rows["Dosaggio"];
                $Scadenza = $rows["Scadenza"];
                print("<p>ID: ".$id.", Nome: ".$Nome_Medicinale.", Principio attivo: ".$Principio_Attivo.", Forma : ".$Forma_Farmaceutica.", Dosaggio: ".$Dosaggio.", Scadenza: ".$Scadenza."</p>");
            }
       }

    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if ($_POST["action"] === "Inserisci") {

            $Nome_Medicinale = $_POST["Nome_Medicinale"];
            $Principio_Attivo = $_POST["Principio_Attivo"];
            $Forma_Farmaceutica = $_POST["Forma_Farmaceutica"];
            $Dosaggio = $_POST["Dosaggio"];
            $Scadenza = $_POST["Scadenza"];

            $query = "INSERT INTO Medicinali (Nome_Medicinale, Principio_Attivo, Forma_Farmaceutica, Dosaggio, Scadenza) VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssss", $Nome_Medicinale, $Principio_Attivo, $Forma_Farmaceutica, $Dosaggio, $Scadenza);
            $stmt->execute();
            print("<p>Inserito correttamente</p>");

        }
 
        if ($_POST["action"] === "Aggiorna") {

            $Nome_Medicinale = $_POST["Nome_Medicinale"];
            $Scadenza = $_POST["Scadenza"];

            $query = "UPDATE Medicinali SET Scadenza = ? WHERE Nome_Medicinale=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $Scadenza, $Nome_Medicinale);
            $stmt->execute();
            print("<p>Aggiornato correttamente</p>");

        }

        if ($_POST["action"] === "Rimuovi") {

            $Nome_Medicinale = $_POST["Nome_Medicinale"];
            
            $query = "DELETE FROM Medicinali WHERE Nome_Medicinale=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $Nome_Medicinale);
            $stmt->execute();
            print("<p>Rimosso correttamente</p>");

        }
    }
    
    print("<a href='index.php'><button>Torna alla homepage</button></a>");

    $conn->close();
?>