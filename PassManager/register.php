<html>
    <head>
        <title>Register</title>
        <?php
             if (!isset($error)){
                 $error = 0; 
             } else {
                $error = $_POST['error'];
             }
             if ($error == 1){
                 echo "Username e/o password errata";
             }
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