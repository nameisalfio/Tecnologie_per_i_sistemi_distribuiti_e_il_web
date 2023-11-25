<!DOCTYPE html>
<html>
<head>
    <title>Esito</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <?php
        session_start();
          
        echo "<br>";
        echo "<p>" . $_SESSION["message"] . "</p>";
        echo "<br>";
    ?>
    <a href="../index.html"><button id="logout">Logout</button></a>
</body>
</html>
