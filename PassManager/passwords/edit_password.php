<html>
    <head>
        <title>Editing Password...</title>
        <script>
            function generatePassword() {
                var length = 12,
                    charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=",
                    retVal = "";
                for (var i = 0, n = charset.length; i < length; ++i) {
                    retVal += charset.charAt(Math.floor(Math.random() * n));
                }
                document.getElementById('password').value = retVal;
            }
        </script>
        <?php
            include "../session/connection.php";
            include "../session/cookie_check.php";
            $password_id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM CREDENZIALE WHERE ID = ?");
            $stmt->bind_param("s", $password_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $pass = $result->fetch_assoc();
            $password = $pass['PASSWORD'];
            $url = $pass['SITO'];
            $mail = $pass['MAIL'];
            if (isset($_GET['error'])){
                echo $_GET['error']."<br>";
            }
        ?>
    </head>
    <body bgcolor="grey">
       <h1>Password Editor</h1>
       <p>Insert the new values for the password <h4><b>(submit if you want to cancel this operation)</b></h4></p>
        <?php
        echo '<form action="./edit.php?id='.$password_id.'" method="post">'
        ?>
            <label for="url">URL:</label>
            <?php
                echo '<input type="text" id="url" name="url" value='.$url.'><br><br>';
            ?>    
            <label for="mail">Mail:</label>
            <?php
            echo '<input type="text" id="mail" name="mail" value='.$mail.'><br><br>';
            ?>
            <label for="password">Password:</label>
            <?php
            echo '<input type="text" id="password" name="password" value='.$password.'><br><br>';
            ?>
            <button type="button" onclick="generatePassword()">Generate Password</button>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
