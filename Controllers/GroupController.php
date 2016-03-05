<?php

require_once '../DBConnection.php';

if(!empty($_POST["nameGrp"])) {

    $nameGrp = $_POST["nameGrp"];
    $courseGrp = $_POST["courseGrp"];
    $facultyGrp = $_POST["facultyGrp"];


    $query = "INSERT grps SET nam_grp = '$nameGrp' , version_grp='1' , num_message='0' , course = '$courseGrp' , faculty = '$facultyGrp'";

    $db->query($query);

    header('Location: /schedule/index.php');

//    $allowed = array("grp_nam","version_grp","num_message"); // allowed fields
//    $sql = "INSERT INTO users SET ".pdoSet($allowed,$values);
//    $stm = $db->prepare($sql);
//    $stm->execute($values);

}
