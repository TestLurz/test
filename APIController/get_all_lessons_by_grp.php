<?php

require_once '../DBConnection.php';

//$db = new PDO('mysql:host=localhost;dbname=schedule','root','3245897');

$response = array();


if (isset($_GET["grp"])) {
    $grp = $_GET['grp'];

    $query = "SELECT * FROM lessons WHERE grp_id = '$grp'";



    $stmt = $db->query($query);

    $response["lesson"] = array();

    $i = 0;

    while ($row = $stmt->fetch()) {
        $i++;
        $lesson = array();
//        echo $grp;
        $idLesson = $lesson["id"] = $row["id"];
        $lesson["teacher"] = $row["teacher"];
        $lesson["subGrp"] = $row["subGrp"];
        $lesson["classRoom"] = $row["classRoom"];
        $lesson["dateLesson"] = $row["dateLesson"];
        $lesson["place"] = $row["place"];
        $lesson["numberLesson"] = $row["numberLesson"];
        $lesson["typeLesson"] = $row["typeLesson"];

        $lesson["dateLesson"] = array();

        $query = "SELECT * FROM dateLesson WHERE lesson_id = '$idLesson'";
        $dateResult = $db->query($query);

        while ($dateRow = $dateResult->fetch()){

            $dateArray = array();
            $dateArray["id"] = $dateRow["id"];
            $dateArray["lesson_date"] = $dateRow["lesson_date"];
            $dateArray["lesson_id"] = $dateRow["lesson_id"];

            array_push($lesson["dateLesson"], $dateArray);
        }

        array_push($response["lesson"], $lesson);
    }

    if($i > 0) {
        $response["success"] = 1;
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "No groups found";

        echo json_encode($response);
    }
}
