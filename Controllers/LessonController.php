<?php

require_once  '../DBConnection.php';

if (!empty($_POST["lesson"])){

    $numbersBlock = $_POST["numberLessonsBlock"];
    $grp =  $_POST["grp"];

    for ($i = 0; $i < $numbersBlock + 1; $i++) {


        $teacher = $_POST["lesson"]["teacher"][$i];
        $subGrp = $_POST["lesson"]["subGrp"][$i];
        $classRoom = $_POST["lesson"]["classRoom"][$i];
        $dateLesson = $_POST["lesson"]["dateLesson"][$i];
        $place = $_POST["lesson"]["place"][$i];
        $numberLesson = $_POST["lesson"]["numberLesson"][$i];
        $nameLesson = $_POST["lesson"]["nameLesson"][$i];
        $typeLesson = $_POST["lesson"]["typeLesson"][$i];



        $datesAfterExplode = explode("; " , $dateLesson);


        $query = "INSERT lessons SET teacher = '$teacher' , nam_subj='$nameLesson' , type_lesson='$typeLesson' , number_lesson='$numberLesson'
      , class_room='$classRoom' , place_lesson='$place' , 	grp_id='$grp' , sub_group='$subGrp'
      ";

        $result = $db->query($query);

        $query = "SELECT version_grp as ver FROM grps WHERE id='$grp'";

        $currentVersion = $db->query($query)->fetchAll(PDO::FETCH_ASSOC)[0]['ver'];
        $currentVersion++;


        $query = "UPDATE grps SET version_grp='$currentVersion' WHERE id='$grp'";
        $db->query($query);

        $query = "SELECT MAX(id) AS num FROM lessons";

        $result = $db->query($query);

        $idMax = $result->fetchAll(PDO::FETCH_ASSOC)[0]['num'];

        foreach($datesAfterExplode as $dates) {
            $d = "2016.".$dates;
            $query = "INSERT dateLesson SET lesson_date	= '$d' , lesson_id='$idMax'";
            $db->query($query);
        }
    }

    header('Location: /schedule/lessonView.php');

}