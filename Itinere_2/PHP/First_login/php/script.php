<link rel="stylesheet" type="text/css" href="../css/style.css">
<?php

$hostname = "localhost";
$username_db = "root";
$password_db = "root";
$name_db = "Database";

$conn = new mysqli($hostname, $username_db, $password_db, $name_db);
if ($conn->connect_error)
    die("Connessione fallita: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] === "GET") 
{
    $query = "SELECT *
              FROM utenti";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            session_start();

            $_SESSION["id"] = $id = $row['id'];
            $_SESSION["username"] = $username = $row['username'];
            $_SESSION["age"] = $age = $row['age'];
            $_SESSION["email"] = $email = $row['email'];

            echo "<form action='update.php' method='POST'>";
            echo "ID: ".$id." - Nome: " . $username . " - Et&agrave;: " . $age . " - Email: " . $email;
            echo "<button id='update'>Aggiorna</button></p><br>";
            echo "<input type='hidden' name='action' value='update'>";
            echo "</form>";
        }
    } 
    else 
    {
        echo "<p>Nessun utente registrato</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    session_start();

    if ($_POST["action"] === "create") 
    {
        $username = $_POST['username'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "INSERT INTO utenti (username, age, email, password) 
                  VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $username, $age, $email, $password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
            $_SESSION["message"] = "Account registrato correttamente";
        else 
            $_SESSION["message"] = "Registrazione account non riuscita. Verifica le tue credenziali";

        sleep(1);
        header("Location: outcome.php");
    }

    if ($_POST["action"] === "login") 
    {        
        $query = "SELECT *
                  FROM utenti 
                  WHERE username = ? AND password = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $_POST["username"], $_POST["password"]); 
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();

            $username = $row['username'];
            $password = $row['password'];

            if ($username === $_POST["username"] && $password === $_POST["password"])
            {
                $_SESSION["username"] = $row["username"];
                $_SESSION["age"] = $row["age"];
                sleep(1);
                header("Location: welcome.php");
                exit();
            }
        }
        else 
        {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
            $_SESSION["message"] = "Login account non riuscito. Verifica le tue credenziali";
            header("Location: outcome.php");
            exit();
        }
    }

    if ($_POST["action"] === "update") 
    {
        session_start();
        //var_dump($_SESSION);

        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $age = $_SESSION['age'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];

        $query = "UPDATE utenti 
                  SET username=?, age=?, email=?, password=?
                  WHERE id=?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $username, $age, $email, $password, $id);
        $stmt->execute();

        $_SESSION["message"] = "Account aggiornato correttamente";

        sleep(1);
        header("Location: outcome.php");
    }

    if ($_POST["action"] === "delete") 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "DELETE 
                  FROM utenti 
                  WHERE username = ? AND password = ?";
                
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) 
            $_SESSION["message"] = "Account rimosso correttamente";
        else 
            $_SESSION["message"] = "Rimozione account non riuscita. Verifica le tue credenziali";

        sleep(1);
        header("Location: outcome.php");
        exit();
    }
    
}

echo "<br><a href='../index.html'><button id='green'>Torna alla homepage</button></a>";

?>