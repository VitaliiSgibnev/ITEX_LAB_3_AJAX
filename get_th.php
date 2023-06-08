<?php
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
include("connect.php");
$teacherName = $_GET["teacherName"];
try {
    $sqlSelect = "SELECT DISTINCT week_day, lesson_number, auditorium, disciple, `type`, title FROM lesson, lesson_teacher, teacher, `groups`, lesson_groups WHERE name=:teacherName AND ID_Teacher=FID_Teacher AND ID_Lesson=FID_Lesson1 AND id_groups=fid_groups AND id_lesson=fid_lesson2";
    // echo "<table border='1'>";
    // echo "<thead><tr><th>week_day</th><th>lesson_number</th><th>auditorium</th><th>disciple</th><th>type</th></th><th>title</th></tr></thead>";
    // echo "<tbody>";
    $sth = $dbh->prepare($sqlSelect);
    $sth->bindValue(":teacherName", $teacherName);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_NUM);
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo "<root>";
    foreach($res as $row){
        echo "<lessonsInfo><week_day>$row[0]</week_day><lesson_number>$row[1]</lesson_number><auditorium>$row[2]</auditorium><disciple>$row[3]</disciple><type>$row[4]</type><title>$row[5]</title></lessonsInfo>";
    }
    echo "</root>";
    // echo "</tbody>";
    // echo "</table>";
}
catch(PDOException $ex) {
    echo $ex->GetMessage();
}