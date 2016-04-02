<?php

require_once "../DBConnection.php";

if(isset($_POST["message"]) && $_POST["message"] != "" && isset($_POST["group"]) && isset($_POST["regId"])) {
    $message = $_POST["message"];
    $group = $_POST["group"];
    $regId = $_POST["regId"];

    $query = "SELECT id  FROM grps WHERE nam_grp = '$group'";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $grpId = $result[0]["id"];

    $query = "INSERT message SET text_msg = '$message', date_sent = NOW(), id_grp = '$grpId'";

    $db->query($query);

    $query = "SELECT gcm_regid FROM gcm_users WHERE gcm_regid <> '$regId' AND grp_id = (SELECT grp_id FROM gcm_users WHERE gcm_regid = '$regId' )";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $gcm_regids = $result["gcm_regid"];

    $registration_ids = array($gcm_regids);
    $message = array("message" => $message);

    $gcm = new GCM();
    $gcm->send_notification($registration_ids, $message);
    echo $result;

}