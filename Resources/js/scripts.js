$(document).ready(function() {

    var currentNumberBlock = 0;
    var $endOfBlocks = $("#endOfBlocks");

    $("#addNewLessons").click(function(){
        currentNumberBlock++;
        $("input[name='numberLessonsBlock']").val(currentNumberBlock);

        $endOfBlocks.before("<div numBlock='" + currentNumberBlock + "' class='row lesson-block'></dic>");
        var $lastLessonBlock = $(".lesson-block:last");
        $lastLessonBlock.append("<div class='col-sm-8 col-sm-offset-2 rowOfFrom'></div>");
        var lastRowOfFrom = $lastLessonBlock.find(".rowOfFrom:last");
        lastRowOfFrom.append("<div class='col-sm-8'><input type='text' class='form-control' required placeholder='Преподаватель' name='lesson[teacher][" + currentNumberBlock + "]'></div>");
        lastRowOfFrom.append("<div class='col-sm-2'><input type='text' class='form-control' required placeholder='Подгруппа' name='lesson[subGrp][" + currentNumberBlock + "]'></div>");
        lastRowOfFrom.append("<div class='col-sm-2'><input type='text' class='form-control' required placeholder='Аудитория' name='lesson[classRoom][" + currentNumberBlock + "]'></div>");
        $lastLessonBlock.append("<div class='col-sm-8 col-sm-offset-2 rowOfFrom'>");
        lastRowOfFrom = $lastLessonBlock.find(".rowOfFrom:last");
        lastRowOfFrom.append("<div class='col-sm-6'><input type='text' class='form-control' required placeholder='Даты проведения' name='lesson[dateLesson][" + currentNumberBlock + "]'></div>");
        lastRowOfFrom.append("<div class='col-sm-4'><input type='text' class='form-control' required placeholder='Место проведения' name='lesson[place][" + currentNumberBlock + "]'></div>");
        lastRowOfFrom.append("<div class='col-sm-2'><input type='text' class='form-control' required placeholder='Номер пары' name='lesson[numberLesson][" + currentNumberBlock + "]'></div>");
        $lastLessonBlock.append("<div class='col-sm-8 col-sm-offset-2 rowOfFrom'>");
        lastRowOfFrom = $lastLessonBlock.find(".rowOfFrom:last");
        lastRowOfFrom.append("<div class='col-sm-10'><input type='text' class='form-control' required placeholder='Название предмета' name='lesson[nameLesson][" + currentNumberBlock + "]'></div>");
        lastRowOfFrom.append("<div class='col-sm-2'><input type='text' class='form-control' required placeholder='Тип занятия' name='lesson[typeLesson][" + currentNumberBlock + "]'></div>");
        $lastLessonBlock.append("<div class='col-sm-8 col-sm-offset-2 bottom-line'></div>");

    });

    $("#deleteNewLessons").click(function() {
        if(currentNumberBlock > 0) {
            var $lastLessonBlock = $(".lesson-block:last");
            $lastLessonBlock.remove();
            currentNumberBlock--;
            $("input[name='numberLessonsBlock']").val(currentNumberBlock);
        }
    })
});