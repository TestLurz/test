<?php

require_once "../DBConnection.php";

$response = array();

if (isset($_GET["regId"])) {
    $regId = $_GET["regId"];

    $user = userIdByRegId($regId, $db);

    $userId = $user["id"];
    $grpId = $user["grp_id"];

    $query = "SELECT * FROM message WHERE user_id <> '$userId' and grp_id = '$grpId' ORDER BY id DESC";

    $result = $db->query($query);

    $response["message"] = array();

    $i = 0;

    while ($row = $result->fetch()) {
        $i++;

        $messages = array();

        $messages["id"] = $row["id"];
        $messages["text_msg"] = $row["text_msg"];
        $messages["date_sent"] = $row["date_sent"];

        array_push($response["message"], $messages);

    }

    if ($i > 0) {
        $response["success"] = 1;
        echo json_encode($response);
    } else {
        $response["success"] = 0;
        echo json_encode($response);
    }


}

function userIdByRegId($regId,PDO $db) {
    $query = "SELECT id , grp_id FROM gcm_users WHERE gcm_regid = '$regId'";
    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return $result[0];
}