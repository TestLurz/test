<?php

require_once "../DBConnection.php";
include_once '../GCM/GCM.php';

/**
 * @TODO изменить POST GET
 */

if(isset($_GET["message"]) && $_GET["message"] != "" && isset($_GET["group"]) && isset($_GET["regId"])) {
    $message = $_GET["message"];
    $group = $_GET["group"];
    $regId = $_GET["regId"];

    $query = "SELECT id  FROM grps WHERE nam_grp = '$group'";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $grpId = $result[0]["id"];

    $query = "INSERT message SET text_msg = '$message', date_sent = NOW(), id_grp = '$grpId'";

    $db->query($query);

    $query = "SELECT DISTINCT gcm_regid FROM gcm_users WHERE grp_id = (SELECT DISTINCT grp_id FROM gcm_users WHERE gcm_regid = '$regId' )";
//    $query = "SELECT gcm_regid FROM gcm_users WHERE gcm_regid <> '$regId' AND grp_id = (SELECT grp_id FROM gcm_users WHERE gcm_regid = '$regId' )";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
//
    $gcm_regids = $result["gcm_regid"];

    $registration_ids = array($gcm_regids);
    $message = array("message" => $message);
//
    $gcm = new GCM();
    $gcm->send_notification($registration_ids, $message);
//    print_r( $result);

}