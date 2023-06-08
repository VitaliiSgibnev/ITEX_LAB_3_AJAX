<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
        background-color: grey;
        font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
          "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        }
        h1 {
        text-align: center;
        }
    </style>
    <title>LB_3_AJAX</title>
    <script>
        function get_gr() {
            let groupName = document.getElementById("groupName").value;
            fetch(`get_gr.php?groupName=${groupName}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("tbody").innerHTML = data;
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });
        }
        
        function get_th() {
            let teacherName = document.getElementById("teacherName").value;
            fetch(`get_th.php?teacherName=${teacherName}`)
                .then(response => response.json())
                .then(data => {
                    let XMLBody = "";
                    for (let i = 0; i < 6; i++) {
                        let week_day = data[0].childNodes[i].textContent;
                        XMLBody += "<td>" + week_day + "</td>";
                    }
                    document.getElementById("XMLBody").innerHTML = XMLBody;
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });
        }
        
        function get_au() {
            let auName = document.getElementById("auName").value;
            fetch(`get_au.php?auName=${auName}`)
                .then(response => response.json())
                .then(data => {
                    let res2 = "";
                    for (let i = 0; i < data.length; i++) {
                        let obj = data[i];
                        res2 += "<tr><td>" + obj.week_day + "</td><td>" + obj.lesson_number + "</td><td>" + obj.name + "</td><td>" + obj.disciple + "</td><td>" + obj.type + "</td><td>" + obj.title + "</td></tr>";
                    }
                    document.getElementById("JSONBody").innerHTML = res2;
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });
        }
    </script>
</head>
<body>
    <h1>Сгібнєв В.І. КІУКІ-20-4 </br>
    Варіант 1</h1>
    <hr>
    <section>
        <h2>Розклад занять для довільної групи зі списку:</h2>
            <select name="groupName" id="groupName" >
                <option value="">Оберіть групу за списком</option>
                <?php
                try {
                    foreach($dbh->query("SELECT DISTINCT `title` FROM `groups`") as $row){
                        echo "<option value ='$row[0]'>$row[0]</option>";
                    }
                }
                catch(PDOException $ex){
                    echo $ex->GetMessage();
                }
                ?>
            </select>
            <input type="button" value="Переглянути" onclick="get_gr()">
            <table border='1'>
            <thead><tr><th>week_day</th><th>lesson_number</th><th>auditorium</th><th>name</th><th>disciple</th><th>type</th></tr></thead>
            <tbody id="tbody">
            </tbody>
            </table>
    </section>
    <section>
        <h2>Розклад занять для довільного викладача зі списку:</h2>
        <select name="teacherName" id="teacherName">
                <option value="">Оберіть викладача за списком</option>
                <?php
                try {
                    foreach($dbh->query("SELECT DISTINCT `name` FROM `teacher`") as $row){
                        echo "<option value ='$row[0]'>$row[0]</option>";
                    }
                }
                catch(PDOException $ex){
                    echo $ex->GetMessage();
                }
                ?>
            </select>
            <input type="button" value="Переглянути" onclick="get_th()">
            <table border='1'>
            <thead><tr><th>week_day</th><th>lesson_number</th><th>auditorium</th><th>disciple</th><th>type</th></th><th>title</th></tr></thead>
            <tbody id="XMLBody"></tbody>
            </table>
    </section>
    <section>
        <h2>Розклад занять для довільної аудиторії зі списку:</h2>
        <select name="auName" id="auName">
                <option value="">Оберіть аудитрію за списком</option>
                <?php
                try {
                    foreach($dbh->query("SELECT DISTINCT `auditorium` FROM `lesson`") as $row){
                        echo "<option value ='$row[0]'>$row[0]</option>";
                    }
                }
                catch(PDOException $ex){
                    echo $ex->GetMessage();
                }
                ?>
            </select>
            <input type="button" value="Переглянути" onclick="get_au()">
            <table border='1'>
            <thead><tr><th>week_day</th><th>lesson_number</th><th>name</th><th>disciple</th><th>type</th><th>title</th></tr></thead>
            <tbody id="JSONBody"></tbody>
            </table>
    </section>
</body>
</html>
