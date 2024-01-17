<!DOCTYPE html>
<html>
<head>
    <title>Benvenuto</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>Benvenuto!</h1>
    <?php
        session_start();
        
        echo "<br>";
        echo "<p>Ti chiami " . $_SESSION["username"] . " e hai " . $_SESSION["age"] . " anni</p>";
    ?>
    <br><a href="../index.html"><button id="orange">Logout</button></a>
</body>
</html>
