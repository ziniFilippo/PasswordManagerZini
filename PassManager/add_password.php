<html>
    <head>
        <title>Add Credential</title>
        <?php
            session_start();
            if (isset($_GET['error'])){
                echo $_GET['error']."<br>";
            }
        ?>
    </head>
    <body bgcolor="grey">
       <h1>Add a credential</h1>
        <form action="./add.php" method="post">
            <label for="password">Password:</label>
            <input type="text" id="password" name="password"><br><br>
            <label for="url">URL:</label>
            <input type="text" id="url" name="url"><br><br>
            <label for="mail">Mail:</label>
            <input type="text" id="mail" name="mail"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
