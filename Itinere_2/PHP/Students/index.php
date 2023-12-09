<!--
    CONSEGNA : 

    Sviluppare una WebApp per la gestione degli studenti di un'università.

    - Visualizzazione degli Studenti:

    La homepage della WebApp deve mostrare la lista degli studenti presenti nel database.
    Per ogni studente, devono essere visualizzati: matricola, nome, cognome e corso di laurea.
    Se nessuno studente è presente, visualizzare il messaggio "Nessuno studente presente".

    - Inserimento Studente:

    Deve essere possibile inserire un nuovo studente tramite un modulo HTML.
    Il modulo deve richiedere il nome, cognome e corso di laurea del nuovo studente.
    Dopo l'inserimento, visualizzare un messaggio di conferma.

    - Visualizzazione Dettagli Studente:

    Cliccando sul corso di laurea di uno studente, la WebApp deve mostrare i dettagli del corso di laurea.
    Se il corso di laurea non è associato a nessun corso nel database, visualizzare un messaggio appropriato.

    (OPZIONALE)

    Nella pagina che mostra i dettagli si necessita di :

    - Aggiornamento Corso di Laurea:

    La WebApp deve consentire di cambiare il corso di laurea di uno studente.
    Utilizzare un form per raccogliere il nuovo corso di laurea.
    Dopo l'aggiornamento, visualizzare un messaggio di conferma.
    
    - Rimozione Studente:

    Permettere la rimozione di uno studente tramite un'apposita funzionalità.
    Chiedere conferma prima di procedere con la rimozione.
    Visualizzare un messaggio di conferma dopo la rimozione.
-->

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <?php
            $conn = new mysqli("localhost", "root", "root", "University");
            if ($conn->connect_error)
                die($conn->connect_error);

            $query = "SELECT * FROM students";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows > 0) {
                print("<h2>Studenti presenti:</h2>");
                while ($rows = $res->fetch_assoc()) {
                    print("<p>Matricola: ".$rows["matricola"].
                        ", nome: ".$rows["nome"].
                        ", Cognome: ".$rows["cognome"].
                        ", Corso di laurea: <a href='script.php?nome=".$rows["nome"].
                                                           "&corso=".$rows["corso_di_laurea"].
                                                           "&matricola=".$rows["matricola"]."'>".$rows["corso_di_laurea"]."</a></p>");
                } 
            } else {
                print("Nessuno studente presente");
            }

            $stmt->close();
            $conn->close();
        ?>
    </head>
    <body>
        <br>
        <h3>Inserisci studente</h3>
        <form action="script.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome"><br>
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome"><br>
            <label for="corso">Corso di laurea:</label>
            <input type="text" id="corso" name="corso"><br><br>
            <button type="submit">Inserisci studente</button>
            <input type="hidden" name="action" value="create">
        </form>

    </body>
</html>


