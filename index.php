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
            echo $row['nam_grp'] . "\n";
        ?>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>

        <div class="row addNewGroup">

            <form method="post" action="Controllers/GroupController.php">
                <div class="col-sm-4 col-sm-offset-3">
                    <input type="text" class="form-control" name="nameGrp" placeholder="Название группы">
                    </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>



    </div>
</body>
</html>
