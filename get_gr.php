<?php
include("connect.php");
$groupName = $_GET["groupName"];
try {
    $sqlSelect = "SELECT DISTINCT `week_day`, `lesson_number`, `auditorium`, `name`,`disciple`, `type` FROM `lesson`, `groups`, `lesson_groups`, teacher, lesson_teacher WHERE `title` = :groupName AND `ID_Groups` = `FID_Groups` AND `ID_Lesson` = `FID_Lesson2` AND ID_Teacher = Fid_Teacher AND id_Lesson=fid_lesson1";
    $sth = $dbh->prepare($sqlSelect);
    $sth->bindValue(":groupName", $groupName);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_NUM);
    foreach($res as $row){
        echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";
    }
}
catch(PDOException $ex) {
    echo $ex->GetMessage();
}