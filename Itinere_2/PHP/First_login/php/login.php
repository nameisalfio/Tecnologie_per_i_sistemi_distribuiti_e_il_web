<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();

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
    $query = "SELECT *
              FROM utenti 
              WHERE email = ? AND password = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password); // set
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $row["username"];
        $_SESSION["age"] = $row["age"];

        $stmt->close();
        $conn->close();

        sleep(1);
        header("Location: welcome.php");
        exit();
    }
    else 
    {
        $_SESSION["message"] = "Login account non riuscito. Verifica le tue credenziali";
        
        $stmt->close();
        $conn->close();

        header("Location: outcome.php");
        exit();
    }
}
?>
