<html>
    <head>
        <title>Register</title>
        <?php
            session_start();
            if ($_SESSION["error"] == 1){
                echo "Inserisci username e/o password";
            }
            $_SESSION["error"] = 0; 
        ?>
    </head>
    <body bgcolor="grey">
       <h1>Registration Password Manager</h1>
        <form action="./register_control.php" method="post">
            <label for="user">Username:</label>
            <input type="text" id="user" name="user"><br><br>
            <label for="password">Password:</label>
            <input type="text" id="password" name="password"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>