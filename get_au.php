<?php
include("connect.php");
$auName = $_GET["auName"];
try {
    $sqlSelect = "SELECT DISTINCT week_day, lesson_number, `name`, disciple, `type`, title FROM lesson, teacher, lesson_teacher, `groups`, lesson_groups WHERE auditorium=:auName AND ID_Teacher=FID_Teacher AND ID_Lesson=FID_Lesson1 AND id_groups=fid_groups AND id_lesson=fid_lesson2";
    // echo "<table border='1'>";
    // echo "<thead><tr><th>week_day</th><th>lesson_number</th><th>name</th><th>disciple</th><th>type</th><th>title</th></tr></thead>";
    // echo "<tbody>";
    $sth = $dbh->prepare($sqlSelect);
    $sth->bindValue(":auName", $auName);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($res);
    // foreach($res as $row){
    //     echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";
    // }
//     echo "</tbody>";
//     echo "</table>";
}
catch(PDOException $ex) {
    echo $ex->GetMessage();
}