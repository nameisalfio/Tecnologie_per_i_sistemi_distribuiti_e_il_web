<?php
$titolo = htmlspecialchars($_GET['titolo']);
?>

<html>
    <head>
      <link rel="stylesheet" type="text/css" href="./css/style.css">
      <title>Books</title>
    </head>
    <body>

        <h1>Form di aggiornamento</h1>
        <br>
        
        <strong><h3>Possibilit&agrave; di modificare autore e prezzo</h3></strong>
        <form action="script.php" method="post">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="titolo" value="<?php echo $titolo; ?>">
            <br>            
            <label for="autore">Autore:</label>
            <input type="text" id="autore" name="autore" required>
            <br>
            <label for="prezzo">Prezzo:</label>
            <input type="text" id="prezzo" name="prezzo" required>
            <br>    
            <br>
            <button type="submit">Aggiorna</button>
        </form> 

        <br>

        <strong><h3>Possibilit&agrave; di eliminare il libro</h3></strong>
        <form action="script.php" method="post">
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="titolo" value="<?php echo $titolo; ?>">
          <button type="submit">Cancella</button>
        </form> 

    </body>
</html>
