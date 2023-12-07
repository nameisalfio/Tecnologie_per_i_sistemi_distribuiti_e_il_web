<!--
    Il database mySql Cinema contiene le tabelle flist (lista dei film) e wlist (lista dei film desiderati).
    Le tabelle sono uguali e hanno i seguenti campi: titolo VARCHAR(30) NOT NULL e regista VARCHAR(30).

    Implementare mediante PHP una o piú    pagine web che presentino:
            una sezione con un titolo a caso cercato in flist scritto sotto:<h1>film consigliato:</h1><br>
            una sezione con un form con due campi input: film e regista e un pulsante submit che aprirà la stessa o un’altra pagina inviandole i 
    dati del form col metodo POST.

    Una Volta ricevuti i dati, viene eseguita una query che cerca record di flist con titolo o regista corrispondenti a quelli inseriti.
    Se esiste almeno un risultato:
            viene stampato sotto la scritta:<h1>film richiesto/i:</h1><br>
            viene fornito un link per tornare indietro 

    altrimenti:

    se il titolo non esiste nella wlist allora viene chiesto se si vuole aggiungere il film richiesto nella wish list, mediante un form con due 
    pulsanti submit: si e no.

    La pressione di si determina l’inserimento di titolo e regista nella tabella wlist, la pressione di no reindirizza alla pagina iniziale.

    Bonus: inserire un link o un pulsante in un form che mostra nella stessa o in una nuova pagina:
            la wish list
            un pulsante per svuotarla
            un link per tornare indietro

    $servername = "localhost"
    $username = "username";
    $password = "password";
    $dbname = "Cinema";

    Funzione per numero causale:
        rand(int $min, int $max): int

    Suggerimento: il form con i due pulsanti si e no dovrebbe anche ritrasmettere il titolo e il regista
-->

<html>
    <head>
      <link rel="stylesheet" type="text/css" href="./css/style.css">
      <title>Cinema</title>
    </head>
    <body>
        <?php 
            $conn = new mysqli("localhost", "root", "root", "Cinema");

            $query = "SELECT * FROM flist ORDER BY RAND() LIMIT 1";
            $result = $conn->query($query);

            while ($rows = $result->fetch_assoc())
                echo "<h1>Film consigliato: ".$rows["titolo"]."</h1>";

            $conn->close();
        ?>

        <form action="script.php" method="post">
            <label for="titolo">Titolo:</label>
            <input type="text" id="titolo" name="titolo" required><br>
            <label for="regista">Regista:</label>
            <input type="text" id="regista" name="regista" required><br><br>
            <button>Cerca adesso</button>
        </form>

    </body>
</html>

