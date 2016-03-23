<?php

require_once "../DBConnection.php";

if(isset($_POST["message"]) && $_POST["message"] != "" && isset($_POST["group"])) {
    $message = $_POST["message"];
    $group = $_POST["group"];

    $query = "SELECT id  FROM grps WHERE nam_grp = '$group'";

    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    $grpId = $result[0]["id"];

    $query = "INSERT message SET text_msg = '$message', date_sent = NOW(), id_grp = '$grpId'";

    $db->query($query);

}