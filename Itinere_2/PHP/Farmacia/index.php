<?php
    $conn = new mysqli("localhost", "root", "root", "Farmacia");
    $query = "SELECT Principio_Attivo, Nome_Medicinale FROM Medicinali";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $res = $stmt->get_result();

    $Principi_Attivi = array();
    $Nomi_Medicinali = array();

    while ($rows = $res->fetch_assoc()) {
        $Principi_Attivi[] = $rows["Principio_Attivo"];
        $Nomi_Medicinali[] = $rows["Nome_Medicinale"];
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
        <h1>Farmacia</h1>

        <h3>Inserimento di un record</h3>
        <form action="farmacia.php" method="POST">
            Nome medicinale:<input type="text" name="Nome_Medicinale"><br>
            Principio attivo:
            <select name="Principio_Attivo">
                <?php foreach ($Principi_Attivi as $principioAttivo): ?>
                    <option value="<?php echo $principioAttivo; ?>"><?php echo $principioAttivo; ?></option>
                <?php endforeach; ?>
            </select><br>
            Forma farmaceutica:<input type="text" name="Forma_Farmaceutica"><br>
            Dosaggio:<input type="text" name="Dosaggio"><br>
            Scadenza:<input type="date" name="Scadenza"><br><br>
            <input type="submit" name="action" value="Inserisci">
        </form>

        <h3>Ricerca di un record</h3>
        <form action="farmacia.php" method="GET">
            Principio attivo:
            <select name="Principio_Attivo">
                <?php foreach ($Principi_Attivi as $principioAttivo): ?>
                    <option value="<?php echo $principioAttivo; ?>"><?php echo $principioAttivo; ?></option>
                <?php endforeach; ?>
                <option value='Vedi tutti'>Vedi tutti</option>
            </select>
            <input type="submit" name="action" value="Ricerca">
        </form>

        <h3>Aggiornamento di un record</h3>
        <form action="farmacia.php" method="POST">
            Nome medicinale:
            <select name="Nome_Medicinale">
                <?php foreach ($Nomi_Medicinali as $nomeMedicinale): ?>
                    <option value="<?php echo $nomeMedicinale; ?>"><?php echo $nomeMedicinale; ?></option>
                <?php endforeach; ?>
            </select>
            Scadenza:<input type="date" name="Scadenza">
            <input type="submit" name="action" value="Aggiorna">
        </form>

        <h3>Rimozione di un record</h3>
        <form action="farmacia.php" method="POST">
            Nome medicinale:
            <select name="Nome_Medicinale">
                <?php foreach ($Nomi_Medicinali as $nomeMedicinale): ?>
                    <option value="<?php echo $nomeMedicinale; ?>"><?php echo $nomeMedicinale; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="action" value="Rimuovi">
        </form>
        
    </body>
</html>
