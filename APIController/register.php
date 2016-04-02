<?php

$json = array();

if( isset($_POST["group"]) && isset($_POST["regId"]) ) {
    $group = $_POST["group"];
    $regId = $_POST["regId"];

    $query = "SELECT id  FROM grps WHERE nam_grp = '$group'";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $grpId = $result[0]["id"];

    $query = "INSERT gcm_users SET gcm_regid = '$regId', grp_id = '$grpId'";

    $db->query($query);
}