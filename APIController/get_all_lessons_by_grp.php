<?php

require_once '../DBConnection.php';


$response = array();
header('Content-Type: text/html; charset=utf-8');


if (isset($_GET["grp"])) {
    $grp = $_GET['grp'];

    $query = "SELECT id  FROM grps WHERE nam_grp = '$grp'";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $grpId = $result[0]["id"];


    $query = "SELECT * FROM lessons WHERE grp_id = '$grpId'";


    $stmt = $db->query($query);

    $response["lesson"] = array();

    $i = 0;

    while ($row = $stmt->fetch()) {
        $i++;
        $lesson = array();
        $idLesson = $lesson["id"] = $row["id"];
        $lesson["teacher"] = $row["teacher"];
        $lesson["subGrp"] = $row["sub_group"];
        $lesson["namSubj"] = $row["nam_subj"];
        $lesson["classRoom"] = $row["class_room"];
        $lesson["dateLesson"] = $row["dateLesson"];
        $lesson["place"] = $row["place_lesson"];
        $lesson["numberLesson"] = $row["number_lesson"];
        $lesson["typeLesson"] = $row["type_lesson"];

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
} else {
    $response["success"] = 0;
    $response["message"] = "No groups found";

    echo json_encode($response);
}
