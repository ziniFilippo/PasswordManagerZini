<html>
<head>
    <title>View Passwords</title>
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
</head>
<body>
<?php
    include "../session/connection.php";
    include "../session/cookie_check.php";

    $stmt = $conn->prepare("SELECT DATA,SITO,MAIL FROM CREDENZIALE WHERE ACCOUNT_ID = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $last_password_update = new DateTime($row['DATA']);
    $current_date = new DateTime();
    $sito = $row['SITO'];
    $mail = $row['MAIL'];

    $interval = $last_password_update->diff($current_date);
    if ($interval->m >= 1) {
        echo "<script>alert('È passato un mese dall'ultimo aggiornamento della tua password. Per favore, aggiorna la tua password.(sito:[".$sito."];mail:[".$mail."]');</script>";
    }
?>

<script>
        function remove(id){
            let choice = confirm("Are you sure you want to delete this password?");
            if (choice == true){
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "./delete_password.php?id=" + id, true);
                xhr.onload = function() {                
                    search(document.getElementById('search').value);
                }
                xhr.send();
            }
            return;
        }
        function edit(id){
            window.location.href = "./edit_password.php?id=" + id;
        }
        function search(query) {
            console.log(query);
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "./search_api.php?search=" + query);
            xhr.onload = function() {
                const data = JSON.parse(xhr.responseText);
                var results = document.getElementById('results');
                results.innerHTML = "";

                if (data.hasOwnProperty('error')){
                    results.innerHTML = "<br>"+data['error'];
                    return;
                }

                var table = document.createElement('table');
                var headerRow = document.createElement('tr');
                ['URL', 'MAIL', 'PASSWORD', 'DATA', 'EDIT', 'DELETE'].forEach(function(header) {
                    var th = document.createElement('th');
                    th.textContent = header;
                    headerRow.appendChild(th);
                });
                table.appendChild(headerRow);

                for (var i = 1; i < data.length; i++) {
                    var row = document.createElement('tr');
                    ['SITO', 'MAIL', 'PASSWORD', 'DATA'].forEach(function(field) {
                        var td = document.createElement('td');
                        td.textContent = data[i][field];
                        row.appendChild(td);
                    });
                    var pass_id = data[i]['ID'];
                    var editButton = document.createElement('button');
                    editButton.textContent = 'edit';
                    editButton.onclick = function() { edit(pass_id); };
                    var editCell = document.createElement('td');
                    editCell.appendChild(editButton);
                    row.appendChild(editCell);

                    var deleteButton = document.createElement('button');
                    deleteButton.textContent = 'delete';
                    deleteButton.onclick = function() { remove(pass_id); };
                    var deleteCell = document.createElement('td');
                    deleteCell.appendChild(deleteButton);
                    row.appendChild(deleteCell);

                    table.appendChild(row);
                }

                results.appendChild(table);
}
                xhr.send();
            }
            onload = function() {
                search("");
            }
    </script>
    <h1>Your Passwords</h1>
    <input type="text" id="search"/>
    <button onclick="search(document.getElementById('search').value)">Search</button>
    
    <div id="results"></div>
<br><br>
<a href="./add_password.php" class = "link">add password</a>
<br><br>
<a href="../home.php" class="link">home</a>
</body>
</html>