<?php

require_once '../DBConnection.php';

$response = array();
if (isset($_GET["faculty"])) {

    $faculty = $_GET["faculty"];

    if ($faculty >= 1 && $faculty <= 3) {// 1 2 3 обозначают номера факультета
        $query = "SELECT * FROM grps WHERE faculty = '$faculty'";

        $stmt = $db->query($query);

        $response["groups"] = array();

        $i = 0;

        while ($row = $stmt->fetch()) {
            $i++;
            $group = array();
            $group["id"] = $row["id"];
            $group["nam_grp"] = $row["nam_grp"];
            $group["version_grp"] = $row["version_grp"];
            $group["num_message"] = $row["num_message"];
            $group["faculty"] = $row["faculty"];
            $group["course"] = $row["course"];


            array_push($response["groups"], $group);
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
        $response["message"] = "Wrong faculty";

        echo json_encode($response);
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Wrong request";

    echo json_encode($response);
}



