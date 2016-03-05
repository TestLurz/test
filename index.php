<?php
require_once 'DBConnection.php';

$query = "SELECT * FROM grps";

$stmt = $db->query($query);
?>

<html>
<head>
    <script type="text/javascript" src="Resources/bootstrap/js/bootstrap.min.js"></script>
    <link href="Resources/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="Resources/css/styles.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 headline-group">
                <h1>Группы</h1>
            </div>
        </div>

        <?php
        while ($row = $stmt->fetch()) {
        ?>
            <div class="row name-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <a href="lessonView.php?grp=<?=($row['id'])?>">
        <?php
        $faculty  = "";
        $course  = "";

        if($row['course'] == 1) $course = "1 курс бакалавриат";
        if($row['course'] == 2) $course = "2 курс бакалавриат";
        if($row['course'] == 3) $course = "3 курс бакалавриат";
        if($row['course'] == 4) $course = "4 курс бакалавриат";
        if($row['course'] == 5) $course = "1 курс магистратура";
        if($row['course'] == 6) $course = "2 курс магистратура";

        if($row['faculty'] == 1) $faculty = "Департамент компьютерной инженерии";
        if($row['faculty'] == 2) $faculty = "Департамент электронной инженерии";
        if($row['faculty'] == 3) $faculty = "Департамент прикладной математики";

            echo $row['nam_grp'] . " - " . $course ." - " . $faculty . "\n";
        ?>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>

        <div class="row addNewGroup">

            <form method="post" action="Controllers/GroupController.php">
                <div class="col-sm-2 col-sm-offset-3">
                    <input type="text" class="form-control" name="nameGrp" placeholder="Название группы">
                </div>
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" name="facultyGrp">
                                <option value="1">Департамент компьютерной инженерии</option>
                                <option value="2">Департамент электронной инженерии</option>
                                <option value="3">Департамент прикладной математики</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control" name="courseGrp">
                                <option value="1">1 курс бакалавриат</option>
                                <option value="2">2 курс бакалавриат</option>
                                <option value="3">3 курс бакалавриат</option>
                                <option value="4">4 курс бакалавриат</option>
                                <option value="5">1 курс магистратура</option>
                                <option value="6">2 курс магистратура</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>



    </div>
</body>
</html>
