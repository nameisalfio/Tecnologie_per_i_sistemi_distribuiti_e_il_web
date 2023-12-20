<!--
    Date le tabelle books2, authors e country, creare una o più pagine in PHP che permettano:

    1) di inserire record, utilizzando i tag Select e Option per specificare l'autore e il paese di pubblicazione.

    2) di effettuare una ricerca di record per autore.

    3) di maggiorare il prezzo del 10% per i record il cui paese di pubblicazione sia l'Italia e del 20% per tutti 
    gli altri paesi.

    uso di Select e Option:
    <select name="nome">
        <option value="valore_1">valore1</option>
        <option value="valore_2">valore2</option>
        .
        .
        .
        <option value="valore_n">valore_n</option>
    </select>

    authors : id firstname lastname year_of_birth
    books2 : id isbn title author publisher country price
    country : id iso name nicename iso3 numcode phonecode
-->

<html>
    <body>
        <h1>Books2</h1>

        <h2>Inserimento</h2>
        <form action="script.php" method="POST">
            ISBN: <input type="text" name="isbn" required><br>
            Title: <input type="text" name="title" required><br>
            Author: 
            <select name="author">
            <?php
                $conn = new mysqli("localhost", "root", "root", "Biblioteca");
                $query = "SELECT id, firstname FROM authors";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $res = $stmt->get_result();

                while($rows = $res->fetch_assoc()) {
                    $id = $rows["id"];
                    $firstname = $rows["firstname"];
                    print ("<option value=".$id.">".$firstname."</option>");
                }
                $conn->close();
            ?>
            </select><br>
            Publisher: <input type="text" name="publisher" required><br>
            Country:
            <select name="country">
            <?php
                $conn = new mysqli("localhost", "root", "root", "Biblioteca");
                $query = "SELECT id, nicename FROM country";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $res = $stmt->get_result();

                while($rows = $res->fetch_assoc()) {
                    $id = $rows["id"];
                    $nicename = $rows["nicename"];
                    print ("<option value=".$id.">".$nicename."</option>");
                }
                $conn->close();
            ?>
            </select><br>
            Price: <input type="text" name="price" required><br><br>
            <input type="submit" name="action" value="Inserisci">
        </form>

        <br>

        <h2>Ricerca</h2>
        <form action="script.php" method="GET">
            Author:
            <select name="author">
            <?php
                $conn = new mysqli("localhost", "root", "root", "Biblioteca");
                $query = "SELECT id, firstname FROM authors";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $res = $stmt->get_result();

                while($rows = $res->fetch_assoc()) {
                    $id = $rows["id"];
                    $firstname = $rows["firstname"];
                    print ("<option value=".$id.">".$firstname."</option>");
                }
                $conn->close();
            ?>
            </select><br><br>
            <input type="submit" name="action" value="Ricerca">
        </form>

    </body>
</html>