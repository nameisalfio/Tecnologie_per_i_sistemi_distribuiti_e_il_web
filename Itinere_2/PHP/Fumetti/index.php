<!--
    Nella tabella 'fumetti' | il campo 'autore' riporta il nome e il cognome dell'autore del fumetto-> 
    Dopo aver aggiunto i campi 'autore_nome' e 'autore_cognome', deve aggiornare questi campi per ogni 
    record estrapolando il nome e il cognome, che nel campo 'autore' sono scritti usando il carattere 
    separatore '-' (dash).
-->

<html>
    <body>
        <?php
            $conn = new mysqli("localhost", "root", "root", "journal");

            $query = "SELECT * FROM fumetti"; 
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $res = $stmt->get_result();

            print("<h2>Fumetti</h2>");
            while($rows = $res->fetch_assoc()) {
                $id = $rows["id"];
                $titolo = $rows["titolo"];
                $genere = $rows["genere"];
                $testata = $rows["testata"];
                $autore = $rows["autore"];
                $autore_nome = $rows["autore_nome"];
                $autore_cognome = $rows["autore_cognome"];
                $anni = $rows["anni"];

                print("<form action='journal.php' method='POST'>");
                print("<p>ID: ".$id." | Titolo: ".$titolo." | Genere: ".$genere." | Testata: ".$testata.
                " | Autore: ".$autore." | Autore_nome: ".$autore_nome." | Autore_cognome: ".$autore_cognome." | Anni: ".$anni);
                print("<input type='hidden' name='id' value='".$id."'>");
                print("<input type='hidden' name='autore' value='".$autore."'>");
                if (!isset($autore_nome))
                    print("<input type='submit' name='action' value='Correggi'>");
                print("<input type='submit' name='action' value='Rimuovi'>");
                print("</p></form>");
            }
        ?>
    </body>
</html>