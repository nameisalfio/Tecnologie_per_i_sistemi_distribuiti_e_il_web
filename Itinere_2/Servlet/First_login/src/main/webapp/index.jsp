<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <strong><p>Benvenuto al login</p></strong>

        <form action="/login" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit" id="login">Login</button>
        </form> 

    </body>
</html>