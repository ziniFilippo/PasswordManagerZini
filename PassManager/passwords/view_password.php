<html>
<style>
    body {
        justify-content: center;
        align-items: center;
        background-color: #343a40;
        linear-gradient(to right top, #343a40, #2b2c31, #211f22, #151314, #000000);
    }
 
    h1 {
        margin: 20px;
        color: #ffffff;
    }
    a.link,p {
        color: #ffffff;
    }
    table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }
    th,td {
        padding: 12px 15px;
        border-bottom: 1px solid #dddddd;
    }
</style>
<?php
    include "../session/connection.php";
    include "../session/cookie_check.php";
?>

    <h1>Your Passwords</h1>
    <input type="text" id="search"/>
    <script>
        function remove(id){
            let choice = confirm("Are you sure you want to delete this password?");
            if (choice == true){
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "./delete_password.php?id=" + id, true);
                xhr.send();
                search(document.getElementById('search').value);
            }
        }
        function search(query) {    
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "./search_api.php?search=" + encodeURIComponent(query), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200)
                var data = JSON.parse(xhr.responseText);
                var table = "<table><tr><th>URL</th><th>MAIL</th><th>PASSWORD</th><th>DATA</th><th>EDIT</th><th>DELETE</th></tr>";
                for (var i = 0; i < data.length; i++) {
                    table += "<tr>";
                    table += "<td>" + data[i]['SITO'] + "</td>";
                    table += "<td>" + data[i]['MAIL'] + "</td>";
                    table += "<td>" + data[i]['PASSWORD'] + "</td>";
                    table += "<td>" + data[i]['DATA'] + "</td>";
                    table += "<td><button onclick='./edit_password.php?id=" + data[i]['ID'] + "'>edit</a></td>";
                    table += '<td><button onclick="remove(data[i]["ID"])">delete</button></td>';
                    table += "</tr>";
                }
                table += "</table>";
                document.getElementById('results').innerHTML = table;
                }
                xhr.send();
            }
    </script>
    <button onclick="search(document.getElementById('search').value)">Search</button>
    
    <div id="results"></div>
<br><br>
<a href="./add_password.php" class = "link">add password</a>
<br><br>
<a href="../home.php" class="link">home</a>
</html>