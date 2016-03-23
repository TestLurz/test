<?php

require_once "../DBConnection.php";

$response = array();

if (isset($_GET["group"])) {
    $group = $_GET["group"];

    $query = "SELECT id  FROM grps WHERE nam_grp = '$group'";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $grpId = $result[0]["id"];

    $query = "SELECT * FROM message WHERE id_grp = '$grpId'";

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