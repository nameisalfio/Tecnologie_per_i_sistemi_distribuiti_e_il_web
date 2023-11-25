<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    session_start();

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connessione al database
    $hostname = "localhost";
    $username_db = "root";
    $password_db = "root";
    $name_db = "Database";

    $conn = new mysqli($hostname, $username_db, $password_db, $name_db);
    if ($conn->connect_error) 
        die("Connessione fallita: " . $conn->connect_error);

    // Utilizzo di prepared statements
    $query = "DELETE 
              FROM utenti 
              WHERE email = ? AND password = ?";
              
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    // Controllo dell'esito dell'operazione
    if ($stmt->affected_rows > 0) 
        $_SESSION["message"] = "Account rimosso correttamente";
    else 
        $_SESSION["message"] = "Rimozione account non riuscita. Verifica le tue credenziali";
        
    $stmt->close();
    $conn->close();

    sleep(1);
    header("Location: outcome.php");
    exit();
}
?>
