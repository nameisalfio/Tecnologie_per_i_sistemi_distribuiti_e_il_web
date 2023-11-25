<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    session_start();

    $username = $_POST["username"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hostname = "localhost";
    $username_db = "root";
    $password_db = "root";
    $name_db = "Database";

    $conn = new mysqli($hostname, $username_db, $password_db, $name_db);
    if ($conn->connect_error) 
        die("Connessione fallita: " . $conn->connect_error);

    // Utilizzo di prepared statements per evitare SQL injection
    $query = "INSERT INTO utenti (username, age, email, password) 
              VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $username, $age, $email, $password);
    $stmt->execute();

    // Controllo dell'esito dell'operazione
    if ($stmt->affected_rows > 0) 
        $_SESSION["message"] = "Account registrato correttamente";
    else 
        $_SESSION["message"] = "Registrazione account non riuscita. Verifica le tue credenziali";
    
    $stmt->close();
    $conn->close();

    sleep(1);
    header("Location: outcome.php");
    exit();
}
?>
