<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/check_login.php");
require_once $_SERVER['DOCUMENT_ROOT']."/data/php/check_device.php";
setlocale(LC_ALL, "ru_RU.UTF-8");
date_default_timezone_set('Europe/Moscow');

$id = $_SESSION['id'];
?>
<style>
    #mainDailyDateBlock{
        <?php
           if($view_version=="Mobile"){
               echo "height:15%;";
           }
           else{
               echo "height:8%;";
           }
        ?>
        width:98%;
        margin-bottom:1%;
        background-color:rgba(30,30,30,0.3);
    }
    #mainFrame{
        <?php
           if($view_version=="Mobile"){
               echo "overflow-x: hidden;";
           }
        ?>
    }
    #timePassDailyBlockShell{
        <?php
           if($view_version=="Mobile"){
               echo "width:100%;";
               echo "height:60%;";
           }
           else{
               echo "width:31%;";
               echo "height:100%;";
           }
        ?>
        background-color:rgba(30,30,30,0.3);
        overflow-y:auto;
        vertical-align:top;
        direction:rtl;
        display:inline-block;
        //margin-top:2%;

    }
    #goalsDailyBlockShell{
        <?php
            if($view_version=="Mobile"){
               echo "width:100%;";
               echo "height:60%;";
               echo "margin-top:2%;";
            }
            else{
               echo "width:40%;";
               echo "height:100%;";
               echo "margin-left:1%;";
            }
        ?>
        background-color:rgba(30,30,30,0.3);
        overflow-y:auto;
        vertical-align:top;
        direction:rtl;
        display:inline-block;
        //margin-top:2%;

    }
    #rightDailyBlock{
        <?php
            if($view_version=="Mobile"){
               echo "width:100%;";
               echo "height:100%;";
               echo "margin-top:2%;";
            }
            else{
               echo "width:26%;";
               echo "height:100%;";
               echo "margin-left:1%;";
            }
        ?>
        vertical-align:top;
        display:inline-block;

    }
    #calendarDailyBlock{
        height:45%;
        width:100%;
        margin-bottom:5%;
        background-color:rgba(30,30,30,0.3);

    }
    #dataDailyBlock{
        height:52%;
        width:100%;
        background-color:rgba(30,30,30,0.3);

    }
    #mainDailyGoalBlock{
        height:84%;
        width:98%;
    }
    #mainGoalImageBlock{
        height:36%;
        width:98%;

    }
    #goalImageBlock{
        height:100%;
        width:18%;
        <?php
            if($view_version=="Mobile"){
            }
            else{
               echo "margin-left:6%;";
            }
        ?>
        display:inline-block;
        opacity:0.9;

    }
    #townImageBlock{
        height:100%;
        width:70%;
        margin-left:4%;
        display:inline-block;
        opacity:0.3;

    }
    textarea{
        <?php
            if($view_version=="Mobile"){
               echo "width: 96%;";
            }
            else{
               echo "width: 87%;";
            }
        ?>

        height: 60%;
    }
</style>
<div class='mainPanelContent' id='Ежедневные цели'>
    <h2 align='center'>Ежедневные цели</h2>

    <div id='mainGoalImageBlock'>
        <div id='townImageBlock'>
            <img height='100%' width='100%' lign='bottom' src='/data/images/town.png'>
        </div>
        <div id='goalImageBlock'>
            <img height='100%' align='bottom' src='/data/images/goal.png'>
        </div>
    </div>

    <div id='mainDailyDateBlock'>
        <div style='width:100%'>

                    <div>
                        <p style='width: 20%;display: inline-block;' onclick='changeDayToPrevious()' align='right'><</p>
                        <p style='width: 56%;text-indent:5%;display: inline-block;' align='center'>
                            <font id='calendar_week_day'>День</font>
                            <font style='text-indent:5%;' id='calendar_day'></font>
                        </p>
                        <p style='width: 20%;display: inline-block;' onclick='changeDayToNext()' align='left'>></p>
                    </div>
        </div>
    </div>

    <div id='mainDailyGoalBlock'>
        <div id='timePassDailyBlockShell'>
            <div style='direction:ltr;' id='timePassDailyBlock'>

            </div>
        </div>

        <div id='goalsDailyBlockShell'>
            <div style='direction:ltr;' id='goalsDailyBlock'>

            </div>
        </div>


        <div id='rightDailyBlock'>
            <div id='calendarDailyBlock'>
                <div>

                <div style='display:inline-block;width:100%;height:100%;'>
                    <div>
                        <p style='width: 20%;display: inline-block;' onclick='changeMonthToPrevious()' align='right'><</p>
                        <p style='width: 56%;text-indent:5%;display: inline-block;' align='center'>
                            <font id='calendar_month'>Календарь</font>
                            <font style='font-size:0.4em' id='calendar_year'></font>
                        </p>
                        <p style='width: 20%;display: inline-block;' onclick='changeMonthToNext()' align='left'>></p>
                    </div>
                    <table style='margin-left: 3%;width: 94%;height: 74%;background-color:transparent'>
                        <?php
                            $day_short_names = array("Пн","Вт","Ср","Чт","Пт","Сб","Вс");
                            echo "<tr>";
                            for($i=0;$i<count($day_short_names);$i++){
                                echo "<th style='color:white'>".$day_short_names[$i]."</th>";
                            }
                            echo "</tr>";
                            for($i=0;$i<6;$i++){
                                echo "<tr>";
                                for($j=0;$j<count($day_short_names);$j++){
                                    $n = $i * count($day_short_names) + $j;
                                    echo "<td id='calendar_cell_".$n."'> </td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>

                </div>
            </div>
            <div id='dataDailyBlock'>
                <p style='display:inline-block;'>Заметки</p>
                <p>
                    <textarea  id='dailyGoalNotes'></textarea>
                </p>

                <p align='right' style='display:inline;margin-left:45%;'><input type='button' value='Архив' onclick='archiveDailyGoalNotes()'>
                <p align='right' style='display:inline;margin-left:2%;'><input type='button' value='Сохранить' onclick='saveDailyGoalNotes()'>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.title = "Ежедневные цели | Гильдия MORDOR";
    mainPanelContent = document.getElementById('mainFrame');
    /*if (typeof next_chat_page !== 'undefined') {
        changeFrameTo(next_bookmarks_page,BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock");
    }
    else{
        changeFrameTo("profile",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock");
    }*/
    mainPanelContent.scrollTop = mainPanelContent.scrollHeight;

    today = '<?php echo strftime ("%d.%m.%Y"); ?>';
    var timer;
    calendarYearCurrent = 0;
    calendarMonthCurrent = 0;
    calendarDayCurrent = 0;
    calendarStartDayCurrent = 0;
    id = 0 <?php echo "+".$id; ?>;
    fillCalendar(today);
    getDailyGoalNotes();
    function loadToTimePassDailyBlock(fullDay){
        $.post('/data/php/load_time_pass_daily_block.php',{'id':id,'day':fullDay}).done(function(html){
            document.getElementById('timePassDailyBlock').innerHTML = html;
        });
    }
    function toChangeTextFromGoalId(goalId){
        if (timer) clearTimeout(timer);
        goalId = goalId.split('_');
        goalId = goalId[goalId.length - 1];
        var divElement = document.getElementById('user_goal_div_'+goalId);
        var pTime = document.getElementById('user_goal_time_'+goalId);
        var pText = document.getElementById('user_goal_'+goalId);
        var pValue = document.getElementById('user_goal_value_'+goalId);
        var pPeriod = document.getElementById('user_goal_period_'+goalId);
        if (typeof pTime === 'undefined' || pTime === null) {
            pTime = '';
        }
        else{
            pTime = pTime.innerHTML;
        }
        if (typeof pText === 'undefined' || pText === null) {
            pText = '';
        }
        else{
            pText = pText.innerHTML;
        }
        if (typeof pValue === 'undefined' || pValue === null) {
            pValue = '';
        }
        else{
            pValue = pValue.innerHTML;
        }
        if (typeof pPeriod === 'undefined' || pPeriod === null) {
            pPeriod = '';
        }
        else{
            pPeriod = pPeriod.innerHTML;
        }
        divElement.innerHTML="<input type='text' autofocus onblur='changeFromGoalIdValue(this.id)' id='textarea_goal_id_"+goalId+"' style='height:6%;width:100%;padding:0;border: none;border-radius: 0;background-color: rgba(30,30,30,0.3);font-size: 0.8em;color: rgba(240,240,240,0.8);' value='"+pTime+" - "+pText+" - "+pValue+" - "+pPeriod+"'>";
        divElement.onclick = function() {
             return false;
           }

    }
    function changeFromGoalIdValue(goalId){
        textareaElement = document.getElementById(goalId);

        goalId = goalId.split('_');
        goalId = goalId[goalId.length - 1];
        textareaValue = textareaElement.value.split(" - ");
        pTime = '';
        pText = ''
        pValue = '';
        pPeriod = '';
        for(i=0;i<textareaValue.length;i++){

            if(textareaValue[i]!=''){
                if(textareaValue[i].search(':')>-1){
                    pTime = textareaValue[i];
                }
                else if(textareaValue[i].search('/')>-1 || i > 1){
                    if(textareaValue[i].search('День')>-1 || textareaValue[i].search('Неделя')>-1 || textareaValue[i].search('Месяц')>-1 || textareaValue[i].search('Год')>-1){
                        pPeriod = textareaValue[i];
                    }
                    else{
                        pValue += textareaValue[i];
                    }
                }
                else{
                    pText = textareaValue[i];
                }
            }
        }
        $.post('/data/php/update_or_create_daily_goal.php',{'id':id,'timeValue':pTime,'textValue':pText,'valueValue':pValue, 'periodValue':pPeriod, 'goalId':goalId,'day':((calendarDayCurrent/10 < 1 ? '0'+calendarDayCurrent : calendarDayCurrent)+'.'+(calendarMonthCurrent/10 < 1 ? '0'+calendarMonthCurrent : calendarMonthCurrent)+'.'+calendarYearCurrent).toString()}).done(function(response){
            //обновить страницу
            if(response == 'Успешно'){

                refreshDailyGoalBlocks();
            }
            else{
                Swal.fire(
                    'Не удалось',
                    'Создать или изменить запись не удалось.',
                    'error'
                );
            }
        });
    }

    function fillDailyBlock(fullDay){
        $.post('/data/php/load_main_pass_daily_block.php',{'id':id,'day':fullDay}).done(function(html){
            document.getElementById('goalsDailyBlock').innerHTML = html;
        });

    }
    function createDailyGoalNewDay(fullDay){
        $.post('/data/php/create_daily_goal_new_day.php',{'id':id,'day':fullDay}).done(function(html){
            fillDailyBlock(fullDay);
            refreshDailyGoalBlocks();
        });

    }
    function deleteGoalFromGoalId(goalId){
        goalId = goalId.split('_');
        goalId = goalId[goalId.length - 1];
        swal.fire({
            title: 'Удаление',
            text: "Удалить",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Полностью',
            cancelButtonText: 'Только в этот день',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.post('/data/php/delete_goal_from_daily_goal.php',{'id':id,'goal_id':goalId}).done(function(html){
                    if(html = 'successsuccess'){
                        Swal.fire(
                            'Успешно',
                            'Цель удалена полностью',
                            'success'
                        );
                        refreshDailyGoalBlocks();
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {

                $.post('/data/php/delete_goal_from_daily_goal.php',{'id':id,'day':((calendarDayCurrent/10 < 1 ? '0'+calendarDayCurrent : calendarDayCurrent)+'.'+(calendarMonthCurrent/10 < 1 ? '0'+calendarMonthCurrent : calendarMonthCurrent)+'.'+calendarYearCurrent).toString(),'goal_id':goalId}).done(function(html){
                    if(html = 'successsuccess'){
                        Swal.fire(
                            'Успешно',
                            'Цель удалена',
                            'success'
                        );
                        refreshDailyGoalBlocks();
                    }
                })
            }
        })

    }
    // TODO: - function fill dataDailyBlock (day)

    // TODO: - function to daily_goal_checklist (goal,status, time)
    // при изменении сохранение в бд

    // TODO: - function save day to daily_goal_checklist (goal,status, time)
    // При первом открытии - подтверждение шаблона

    function getWeekDay(date) {
        day = date.getDay();
        //Смещение воскресенья на конец недели
        return day >= 1 ? day - 1 : 6;
    }
    function getMonthDay(date) {
        return date.getDate();
    }
    function getMonthName(date){
        return date.toLocaleString('ru-ru', { month: 'long' });
    }
    function getWeekDayName(date){
        return date.toLocaleString('ru-ru', { weekday: 'long' });
    }
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    function changeCalendarMonthNameTo(name){
        name = capitalizeFirstLetter(name);
        document.getElementById('calendar_month').innerHTML = name;
    }
    function changeCalendarYearValueTo(year){
        document.getElementById('calendar_year').innerHTML = year;
    }
    function changeCalendarWeekDayNameTo(name){
        name = capitalizeFirstLetter(name);
        document.getElementById('calendar_week_day').innerHTML = name;
    }
    function changeCalendarDayValueTo(day){
        document.getElementById('calendar_day').innerHTML = day;
    }
    function getMonthLastDay(date){
        return 33 - new Date(date.getFullYear(), date.getMonth(), 33).getDate();
    }
    function refreshDailyGoalBlocks(){
        day_text = ((calendarDayCurrent/10 < 1 ? '0'+calendarDayCurrent : calendarDayCurrent)+'.'+(calendarMonthCurrent/10 < 1 ? '0'+calendarMonthCurrent : calendarMonthCurrent)+'.'+calendarYearCurrent).toString();
        loadToTimePassDailyBlock(day_text);
        fillDailyBlock(day_text);
    }
    function fillCalendar(day){
        daySplit = day.split(".");

        calendarYearCurrent = parseInt(daySplit[2]);
        calendarMonthCurrent = parseInt(daySplit[1]);
        calendarDayCurrent = parseInt(daySplit[0]);

        refreshDailyGoalBlocks();

        monthDay = calendarDayCurrent;
        day = new Date(calendarYearCurrent,calendarMonthCurrent-1,calendarDayCurrent);

        changeCalendarMonthNameTo(getMonthName(day));
        changeCalendarYearValueTo(calendarYearCurrent);
        changeCalendarWeekDayNameTo(getWeekDayName(day));
        changeCalendarDayValueTo(calendarDayCurrent);

        let weekDays = 7;
        monthDays = getMonthLastDay(day);

        weekDay = getWeekDay(day);
        startWeekDay = weekDay - monthDay % weekDays + 1;
        calendarStartDayCurrent = startWeekDay;
        if(startWeekDay>=7){
            startWeekDay %= 7;
        }
        if(startWeekDay<0){
            startWeekDay+=7;
        }

        for(i=0 ; i<6*weekDays;i++){
            cell = document.getElementById('calendar_cell_'+i);

            if(i>=startWeekDay & i<startWeekDay+monthDays){
                if(i != monthDay+startWeekDay-1){
                    cell.style.backgroundColor = 'rgba(150,150,150,0.3)';
                    cell.onclick = function(){
                        fillCalendar(((this.id.split('_')[2] - calendarStartDayCurrent+1)+'.'+calendarMonthCurrent+'.'+calendarYearCurrent).toString());
                    }
                }
                else{
                    cell.style.backgroundColor = 'rgba(255,223,0,0.6)';
                }
                cell.setAttribute('title',i-startWeekDay+1);
            }
            else{
                cell.style.backgroundColor = 'transparent';
                cell.onclick = null;
            }

        }

    }
    function changeMonthToPrevious(){
        if(calendarMonthCurrent <= 1){
            month = 12;
            year = calendarYearCurrent - 1;
        }
        else{
            month = calendarMonthCurrent-1;
            year = calendarYearCurrent;
        }
        day = Math.min(calendarDayCurrent,getMonthLastDay(new Date(year,month-1,1)))
        fillCalendar((day+'.'+month+'.'+year).toString());
    }
    function changeMonthToNext(){
        if(calendarMonthCurrent >= 12){
            month = 1;
            year = calendarYearCurrent + 1;
        }
        else{
            month = calendarMonthCurrent+1;
            year = calendarYearCurrent;
        }
        day = Math.min(calendarDayCurrent,getMonthLastDay(new Date(year,month-1,1)))
        fillCalendar((day+'.'+month+'.'+year).toString());
    }
    function changeDayToPrevious(){
        if(calendarDayCurrent<=1){
            if(calendarMonthCurrent<=1){
                month = 12;
                year = calendarYearCurrent - 1;
                day = (getMonthLastDay(new Date(year,month-1,1)));
            }
            else{
                month = calendarMonthCurrent -1;
                year = calendarYearCurrent;
                day = getMonthLastDay(new Date(year,month-1,1));
            }
        }
        else{
            day = calendarDayCurrent - 1;
            month = calendarMonthCurrent;
            year = calendarYearCurrent
        }
        fillCalendar((day+'.'+month+'.'+year).toString());
    }
    function changeDayToNext(){
        if(calendarDayCurrent>=getMonthLastDay(new Date(calendarYearCurrent,calendarMonthCurrent-1,1))){
            if(calendarMonthCurrent>=12){
                month = 1;
                year = calendarYearCurrent + 1;
                day = 1;
            }
            else{
                month = calendarMonthCurrent +1;
                year = calendarYearCurrent;
                day = 1;
            }
        }
        else{
            day = calendarDayCurrent + 1;
            month = calendarMonthCurrent;
            year = calendarYearCurrent
        }
        fillCalendar((day+'.'+month+'.'+year).toString());
    }
    function changeStatusFromGoalId(goalId, status){
        if(status == undefined){
            status = 0;
        }
        if (timer) clearTimeout(timer);
        timer = setTimeout(function() {
            goalId = goalId.split('_');
            goalId = goalId[goalId.length - 1];
            $.post('/data/php/change_goal_status_from_goal_id.php',{'id':id,'day':((calendarDayCurrent/10 < 1 ? '0'+calendarDayCurrent : calendarDayCurrent)+'.'+(calendarMonthCurrent/10 < 1 ? '0'+calendarMonthCurrent : calendarMonthCurrent)+'.'+calendarYearCurrent).toString(),'goal_id':goalId,'current_status':status}).done(function(html){
                if(html = 'success'){
                    refreshDailyGoalBlocks();
                }
            });
        }, 300);
    }
    function goalUserValueAddOne(goalId){
        if (timer) clearTimeout(timer);
        timer = setTimeout(function() {
            goalId = goalId.split('_');
            goalId = goalId[goalId.length - 1];

            var divElement = document.getElementById('user_goal_div_'+goalId);
            var pTime = document.getElementById('user_goal_time_'+goalId);
            var pText = document.getElementById('user_goal_'+goalId);
            var pValue = document.getElementById('user_goal_value_'+goalId);
            var pPeriod = document.getElementById('user_goal_period_'+goalId);
            if (typeof pTime === 'undefined' || pTime === null) {
                pTime = '';
            }
            else{
                pTime = pTime.innerHTML;
            }
            if (typeof pText === 'undefined' || pText === null) {
                pText = '';
            }
            else{
                pText = pText.innerHTML;
            }
            if (typeof pValue === 'undefined' || pValue === null) {
                pValue = '';
            }
            else{
                pValue = pValue.innerHTML;
                if(pValue.search('/')>-1){
                    pValueArray = pValue.split('/');
                    pValue = (parseInt(pValueArray[0])+1) + '/' + pValueArray[1];
                }
                else{
                    pValue = '1/'+pValue;
                }


            }
            if (typeof pPeriod === 'undefined' || pPeriod === null) {
                pPeriod = '';
            }
            else{
                pPeriod = pPeriod.innerHTML;
            }
            $.post('/data/php/update_or_create_daily_goal.php',{'id':id,'timeValue':pTime,'textValue':pText,'valueValue':pValue, 'periodValue':pPeriod, 'goalId':goalId,'day':((calendarDayCurrent/10 < 1 ? '0'+calendarDayCurrent : calendarDayCurrent)+'.'+(calendarMonthCurrent/10 < 1 ? '0'+calendarMonthCurrent : calendarMonthCurrent)+'.'+calendarYearCurrent).toString()}).done(function(response){
                //обновить страницу
                if(response == 'Успешно'){

                    refreshDailyGoalBlocks();
                }
                else{
                    Swal.fire(
                        'Не удалось',
                        'Создать или изменить запись не удалось.',
                        'error'
                    );
                }
            });
        },300);
    }

    function saveDailyGoalNotes(){
        text = document.getElementById('dailyGoalNotes').value;

        id = 0<?php echo "+".$id; ?>;
        $.post('/data/php/save_daily_goal_notes.php',{'text':text,'id':id}).done(function(){

            Swal.fire(
                'Сохранено!',
                'Заметки успешно сохранены.',
                'success'
            );
        });
    }


    function archiveDailyGoalNotes(){
        id = 0<?php echo "+".$id; ?>;
        $.post('/data/php/archive_daily_goal_notes.php',{'id':id}).done(function(){

            Swal.fire(
                'Архивация завершена!',
                'Заметки успешно помощены в архив.',
                'success'
            );
            getDailyGoalNotes();
        });
    }
    function getDailyGoalNotes(){
        dailyGoalNotes = document.getElementById('dailyGoalNotes');
        dailyGoalNotes.setAttribute("disabled", "true");
        id = 0<?php echo "+".$id; ?>;
        $.post('/data/php/get_daily_goal_notes.php',{'id':id}).done(function(text){
            dailyGoalNotes.value = text;
            dailyGoalNotes.removeAttribute("disabled");
        });
    }
</script>