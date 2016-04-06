<?php
$grp = $_GET['grp'];
?>
<html>
<head>
    <script type='text/javascript' src='Resources/bootstrap/js/bootstrap.min.js'></script>
    <link href='Resources/bootstrap/css/bootstrap.min.css' type='text/css' rel='stylesheet'>
    <link href='Resources/css/styles.css' type='text/css' rel='stylesheet'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='Resources/js/scripts.js' type='text/javascript'></script>
</head>
<body>
<div class='container'>
    <form method='post' action='Controllers/LessonController.php'>
        <input type='hidden' value='<?php echo $grp ?>' name='grp'>

        <input type="hidden" value="0" name="numberLessonsBlock">

        <div class='row'>
            <div class='col-sm-12 headline-lesson'>
                <h2>Занятия</h2>
            </div>
        </div>
        <div numBlock='0' class='row lesson-block'>
            <div class='col-sm-8 col-sm-offset-2 rowOfFrom'>
                <div class='col-sm-8'>
                    <input type='text' class='form-control' required placeholder='Преподаватель' name='lesson[teacher][0]'>
                </div>

                <div class='col-sm-2'>
                    <input type='text' class='form-control' required placeholder='Подгруппа' name='lesson[subGrp][0]'>
                </div>

                <div class='col-sm-2'>
                    <input type='text' class='form-control' required placeholder='Аудитория' name='lesson[classRoom][0]'>
                </div>
            </div>

            <div class='col-sm-8 col-sm-offset-2 rowOfFrom'>
                <div class='col-sm-6'>
                    <input type='text' class='form-control' required placeholder='Даты проведения' name='lesson[dateLesson][0]'>
                </div>

                <div class='col-sm-4'>
                    <input type='text' class='form-control' required placeholder='Место проведения' name='lesson[place][0]'>
                </div>

                <div class='col-sm-2'>
                    <input type='text' class='form-control' required placeholder='Номер пары' name='lesson[numberLesson][0]'>
                </div>
            </div>

            <div class='col-sm-8 col-sm-offset-2 rowOfFrom'>
                <div class='col-sm-10'>
                    <input type='text' class='form-control' required placeholder='Название предмета' name='lesson[nameLesson][0]'>
                </div>

                <div class='col-sm-2'>
                    <input type='text' class='form-control' required placeholder='Тип занятия' name='lesson[typeLesson][0]'>
                </div>

            </div>

            <div class="col-sm-8 col-sm-offset-2 bottom-line"></div>
        </div>

        <div class='row' id='endOfBlocks'>
            <div class='col-sm-12'>
                <a id='addNewLessons'>Добавить занятия</a> | <a id='deleteNewLessons'>Удалить занятия</a>
            </div>
            <div class='col-sm-12 submitRowLesson'>
                <button type='submit' class='btn btn-primary'>Submit</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
