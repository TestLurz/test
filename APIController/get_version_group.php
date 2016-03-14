<?php
require_once '../DBConnection.php';

$response = array();

if (isset($_GET["grp"])) {
    $grp = $_GET['grp'];

    $query = "SELECT id , version_grp AS vers FROM grps WHERE nam_grp = '$grp'";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $grpVersion = $result[0]["vers"];

    if (isset($grpVersion)) {
        $response["success"] = 1;
        $response["version"] = $grpVersion;
    } else {
        $response["success"] = 0;
    }


    echo json_encode($response);
}