<?php

$json = array();
if( isset($_POST["group"]) && isset($_POST["regId"]) ) {
    $group = $_POST["group"];
    $regId = $_POST["regId"];

    require_once '../DBConnection.php';

    $query = "SELECT id  FROM grps WHERE nam_grp = '$group'";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);


    $grpId = $result[0]["id"];

    if (checkRegistrationId($regId, $db) == 0 ) {
        $query = "INSERT gcm_users SET gcm_regid = '$regId', grp_id = '$grpId'";
    } else {
        $query = "UPDATE gcm_users SET grp_id = '$grpId' WHERE gcm_regid = '$regId'";
    }
    $db->query($query);

    $json["success"] = 1;
    $json["message"] = "Success";

    echo json_encode($json);
} else {
    $json["success"] = 0;
    $json["message"] = "Wrong request";

    echo json_encode($json);
}


function checkRegistrationId($regId,PDO $db) {
    $query = "SELECT COUNT(*) FROM `gcm_users` WHERE gcm_regid= '$regId'";
    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["COUNT(*)"];
}