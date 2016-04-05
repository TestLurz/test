<?php

require_once "../DBConnection.php";
include_once '../GCM/GCM.php';

/**
 * @TODO изменить POST GET Trigger
 */

if(isset($_POST["message"]) && $_POST["message"] != "" && isset($_POST["group"]) && isset($_POST["regId"])) {
    $message = $_POST["message"];
    $group = $_POST["group"];
    $regId = $_POST["regId"];

    $query = "SELECT id  FROM grps WHERE nam_grp = '$group'";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $grpId = $result[0]["id"];

    $userId = userIdByRegId($regId, $db);

    $query = "INSERT message SET text_msg = '$message', date_sent = NOW(), user_id = '$userId', grp_id='$grpId' ";

    $db->query($query);

//    $query = "SELECT DISTINCT gcm_regid FROM gcm_users WHERE grp_id = (SELECT DISTINCT grp_id FROM gcm_users WHERE gcm_regid = '$regId' )";
    $query = "SELECT gcm_regid FROM gcm_users WHERE gcm_regid <> '$regId' AND grp_id = (SELECT grp_id FROM gcm_users WHERE gcm_regid = '$regId' )";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    $message = array("message" => $message);

    $gcm_regIds = array();
    for($i = 0; $i < count($result); $i++) {
        $gcm_regIds[] = $result[$i]["gcm_regid"];
    }

    $gcm = new GCM();
    $gcm->send_notification($gcm_regIds, $message);

}


function userIdByRegId($regId,PDO $db) {

    $query = "SELECT id FROM gcm_users WHERE gcm_regid = '$regId'";
    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]["id"];
}