<?php

session_start();
include($_SERVER['DOCUMENT_ROOT']."/data/php/db_connect.php");
include($_SERVER['DOCUMENT_ROOT'] . "/data/php/check_login.php");
include($_SERVER['DOCUMENT_ROOT']."/data/php/bookmarks/get_category_options.php");
require_once $_SERVER['DOCUMENT_ROOT']."/data/php/check_device.php";
$role = $_SESSION['role'];
$category_options = getCategoryOptions($db);
?>

<div class='mainPanelContent' id='Мои закладки'>
    <style>
        table{
            <?php
                if($view_version=="Mobile"){
                    echo "font-size: 1.2em;";
                }
                else{
                    echo "font-size: .7em;";

                }
            ?>
             width: 100%;
             border-spacing: 0;
         }
         .top_menu_my_bookmarks_buttons{
            width:12%;
            margin-left:2%;
            margin-right:2%;
         }
         #category_selector{
            width:100%;
         }
         #top_menu_my_bookmarks{
            width:100%;
            height:5%;
            margin-top: 1%;
            margin-bottom: 1%;
            background-color:rgba(15,15,15,0.3);
         }
         td,th {
           text-align: center;
           vertical-align: middle;
           padding-top: 1%;
           padding-bottom: 1%;
         }
    </style>
    <h2 align='center' style='font-size:1.1em;color:white'>Мои закладки</h2>
    <div align='center' style='width:60%;margin-left:20%;'>
        <select id='category_selector' onchange='getMyBookmarksTableData(this.options[this.selectedIndex].value)'>
            <option disabled>Выберите категорию</option>
            <?php
                foreach ($category_options as $name => $values){
                    echo "<option value='".$name."-".$values[0]."-".$values[1]."'>".$name."</option>";
                }
            ?>
        </select>
    </div>
    <div id='top_menu_my_bookmarks' align='center'>
        <input type='button' value='Все' class='top_menu_my_bookmarks_buttons' onclick='getMyBookmarksTableData(selected_category,"Все")'>
        <input type='button' value='В процессе' class='top_menu_my_bookmarks_buttons' onclick='getMyBookmarksTableData(selected_category,"В процессе")'>
        <input type='button' value='Планируется' class='top_menu_my_bookmarks_buttons' onclick='getMyBookmarksTableData(selected_category,"Планируется")'>
        <input type='button' value='Отложено' class='top_menu_my_bookmarks_buttons' onclick='getMyBookmarksTableData(selected_category,"Отложено")'>
        <input type='button' value='Заброшено' class='top_menu_my_bookmarks_buttons' onclick='getMyBookmarksTableData(selected_category,"Заброшено")'>
        <input type='button' value='Завершено' class='top_menu_my_bookmarks_buttons' onclick='getMyBookmarksTableData(selected_category,"Завершено")'>
    </div>
    <table  id='myBookmarksTable'>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Автор</th>
            <th>Оценка</th>
            <th>Прогресс</th>
        </tr>

    </table>
</div>
<script>
    if(typeof selected_category !== 'undefined'){
        getMyBookmarksTableData(selected_category);
        document.getElementById('category_selector').options[document.getElementById('category_selector').selectedIndex].value;
    }
    else{
        selected_category = document.getElementById('category_selector').options[document.getElementById('category_selector').selectedIndex].value;
        getMyBookmarksTableData(selected_category);
    }
    function getMyBookmarksTableData(values,progress='Все'){
        selected_category = values;
        $('#category_selector').val(selected_category);
        values = values.split('-');
        $.post('/data/php/bookmarks/get_my_bookmarks_table_data.php',{'id':id,'category':values[0],'value':values[1],'author':values[2],'progress':progress}).done(function(html){
            document.getElementById('myBookmarksTable').innerHTML = html;
        });
    }
    function myBookmarksValueAddOne(bookmarkId){
        bookmarkId = bookmarkId.split('_');
        bookmarkId = bookmarkId[bookmarkId.length - 1];
        valueId = 'value_'+bookmarkId;
        values = document.getElementById(valueId).innerHTML;
        values = values.split('/');
        value = values[0];
        if(value == '-'){
            value = 1;
        }
        else{
            value++;
        }
        $.post('/data/php/bookmarks/value_add_one.php',{'id':id,'bookmark_id':bookmarkId,'value':value}).done(function(response){
            if(response =='Успешно'){
                if(value < values[1].split('<')[0]){
                    document.getElementById(valueId).innerHTML = value + '/' + values[1]+'/'+values[2];
                }
                else{
                    refreshMyBookmarks();
                }
            }
        });


    }
    function refreshMyBookmarks(){
        changeFrameTo("my_bookmarks",BOOKMARKS_PAGES_PREFIX,"","#bookmarksBlock");
    }
    function editFromMyBookmarks(bookmarkId){
        bookmarkId = bookmarkId.split('_');
        bookmarkId = bookmarkId[bookmarkId.length - 1];
        name = document.getElementById('my_bookmark_name_'+bookmarkId).innerHTML;
        score = document.getElementById('my_bookmark_score_'+bookmarkId).innerHTML;
        valueId = 'value_'+bookmarkId;
        values = document.getElementById(valueId).innerHTML;
        values = values.split('/');
        value = values[0];
        if(value == '-'){
            value = 0;
        }
        optionsProgressHTML = "";
        optionTag = ['<option value="','"','>','</option>'];
        optionValues = ['В процессе','Планируется','Отложено','Заброшено','Завершено'];
        selectedProgress = 'В процессе';
        rowColor = document.getElementById('my_bookmark_row_'+bookmarkId).style.backgroundColor;
        switch(rowColor){
            case 'rgba(45, 176, 57, 0.7)':
                selectedProgress = 'В процессе';
                break;
            case 'rgba(195, 195, 195, 0.7)':
                selectedProgress = 'Планируется';
                break;
            case 'rgba(249, 212, 87, 0.7)':
                selectedProgress = 'Отложено';
                break;
            case 'rgba(161, 47, 49, 0.7)':
                selectedProgress = 'Заброшено';
                break;
            case 'rgba(38, 68, 143, 0.7)':
                selectedProgress = 'Завершено';
                break;
        }
        for(i=0;i<optionValues.length;i++){
            if(selectedProgress == optionValues[i]){
                optionSelected = ' selected ';
            }
            else{
                optionSelected = '';
            }
            optionsProgressHTML+=optionTag[0]+optionValues[i]+optionTag[1]+optionSelected+optionTag[2]+optionValues[i]+optionTag[3];
        }
        optionsScoreHTML = "";
        optionTag = ['<option value="','"','>','</option>'];
        optionValues = ['(10) Шедевр','(9) Отлично','(8) Очень хорошо','(7) Хорошо','(6) Неплохо','(5) Нормально','(4) Плохо','(3) Очень плохо','(2) Ужасно','(1) Отвратительно'];
        for(i=0;i<optionValues.length;i++){
            optionScore = 10 - i;
            if(optionScore == score){
                optionSelected = ' selected ';
            }
            else{
                optionSelected = '';
            }
            optionsScoreHTML+=optionTag[0]+optionScore+optionTag[1]+optionSelected+optionTag[2]+optionValues[i]+optionTag[3];
        }
        Swal.fire({
            title: 'Редактирование',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Сохранить',
            cancelButtonText: 'Отмена',
            html:
                '<input id="swal-input1" value="'+name+'" disabled class="swal2-input">' +
                '<select id="swal-input2" class="swal2-input">'+optionsProgressHTML+'</select>' +
                '<select id="swal-input3" class="swal2-input">'+optionsScoreHTML+'</select>' +
                '<input id="swal-input4" placeholder="Значение" value="'+value+'" class="swal2-input">',
            preConfirm: function () {
                return new Promise(function (resolve) {
                    resolve([
                        ($('#swal-input1').val()).toString(),
                        document.getElementById('swal-input2').options[document.getElementById('swal-input2').selectedIndex].value,
                        document.getElementById('swal-input3').options[document.getElementById('swal-input3').selectedIndex].value,
                        $('#swal-input4').val()
                    ])
                })
            },
            onOpen: function () {
                $('#swal-input1').focus()
            }
        }).then(function (result) {
            if (result.value) {
                progress = result['value'][1];
                score = result['value'][2];
                value = result['value'][3];

                $.post('/data/php/bookmarks/update_my_bookmark_score_value.php',{'id':id,'bookmark_id':bookmarkId,'value':value,'score':score,'progress':progress}).done(function(response){
                    if(response =='Успешно'){
                        Swal.fire(
                            'Успешно',
                            'Успешно обновлено.',
                            'success'
                        );
                        refreshMyBookmarks();
                    }
                });
              } else {
                // error or empty
            }

        })
    }
    function deleteFromMyBookmarks(bookmarkId){
        bookmarkId = bookmarkId.split('_');
        bookmarkId = bookmarkId[bookmarkId.length - 1];
        Swal.fire({
            title: 'Удалить?',
            text: 'Закладка будет удалена.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Удалить',
            cancelButtonText: 'Отмена'

        }).then((result) =>{

            if(result.value) {
                $.post('/data/php/bookmarks/delete_my_bookmark.php',{'id':id,'bookmark_id':bookmarkId}).done(function(html){
                    if(html == "Успешно"){
                        Swal.fire(
                            'Удаление завершено!',
                            'Закладка была удалена.',
                            'success'
                        );
                        refreshMyBookmarks();
                    }
                    else{
                        Swal.fire(
                            'Не удалось удалить.',
                            'Попробуйте снова позже.',
                            'error'
                        );
                    }
                })
            }

        })
    }
</script>