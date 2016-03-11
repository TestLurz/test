<?php

require_once '../DBConnection.php';

//$db = new PDO('mysql:host=localhost;dbname=schedule','root','3245897');

$response = array();


if (isset($_GET["grp"])) {
    $grp = $_GET['grp'];

    $query = "SELECT id FROM grps WHERE nam_grp = '$grp'";

    $grpId = $db->query($query)->fetchAll(PDO::FETCH_ASSOC)[0]["id"];

    $query = "SELECT DISTINCT lessons.* FROM lessons , dateLesson WHERE grp_id = '$grpId' and lessons.id = dateLesson.lesson_id
    and DAY(dateLesson.lesson_date) >= DAY(NOW()) and DAY(dateLesson.lesson_date) <= DAY(NOW()) + 7";


    $stmt = $db->query($query);

    $response["lesson"] = array();

    $i = 0;

    while ($row = $stmt->fetch()) {
        $i++;
        $lesson = array();
//        echo $grp;
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
