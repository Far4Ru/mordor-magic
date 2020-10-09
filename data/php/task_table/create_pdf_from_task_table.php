<?php
    session_start();
    setlocale(LC_ALL, "ru_RU.UTF-8");
    date_default_timezone_set('Europe/Moscow');
    if(isset($_POST['update_all'])){
        $day = strftime("%d_%m_%Y",strtotime("-1 days"));
        $day_point = strftime("%d.%m.%Y",strtotime("-1 days"));
    }
    if(isset($_POST['day'])){
        if($_POST['day']=='yesterday'){
            $day = strftime("%d_%m_%Y",strtotime("-1 days"));
            $day_point = strftime("%d.%m.%Y",strtotime("-1 days"));
        }
        elseif($_POST['day']=='today'){
            $day = strftime("%d_%m_%Y");
            $day_point = strftime("%d.%m.%Y");
        }
    }
    else{
        $day = strftime("%d_%m_%Y");
        $day_point = strftime("%d.%m.%Y");
    }
    $_SESSION['savedDay'] = $day;
    $_SESSION['savedDayPoint'] = $day_point;
    $fpdf_folder = $_SERVER['DOCUMENT_ROOT']."/data/libs/fpdf/";

    include ("../db_connect.php");
    require($fpdf_folder."fpdf.php");

    include($_SERVER['DOCUMENT_ROOT']."/data/php/task_table/get_task_table_data.php");
    $nickname = $_SESSION['nickname'];
    list($all_events,$all_characters,$all_completion,$all_possible_events) = get_task_table_data($nickname,$db);


    class TaskTablePDF extends FPDF {
        const FIRST_COLUMN_WIDTH = 16;
        const CELL_WIDTH = 20;
        const CELL_HEIGHT = 3;
        const CELL_HEADER_FONT_SIZE = 6;

        function header(){
            $day = $_SESSION['savedDay'];
            $day_point = $_SESSION['savedDayPoint'];
            $nickname = $_SESSION['nickname'];
            $icons_folder = $_SERVER['DOCUMENT_ROOT']."/data/icons/";
            $this -> Image($icons_folder."mordor_icon.png",10,5,20,20);
            $this -> AddFont("Arial","B");
            $this -> SetFont("Arial","B",14);
            $this -> Cell (276,5,"Таблица заданий",0,0,"C");
            $this -> Ln();
            $this -> AddFont("Arial","");
            $this -> SetFont("Arial","",5);
            $this -> Cell(276,4,$day_point,0,0,"C");
            $this -> Ln();
            $this -> SetFont("Arial","",10);
            $this -> Cell(276,10,$nickname,0,0,"C");
            $this -> Ln(20);
        }
        function footer(){
            $this -> SetY(-15);
            $this -> AddFont("Arial","");
            $this -> SetFont("Arial","",8);
            $this -> Cell(0,10,"Страница ".$this->PageNo()."/{nb}",0,0,"C");
        }
        function headerTable($all_events){
            $this -> AddFont("TimesNewRoman","");
            $this -> SetFont("TimesNewRoman","",self::CELL_HEADER_FONT_SIZE);
            $this -> Cell (self::FIRST_COLUMN_WIDTH,self::CELL_HEIGHT,' ',1,0,'C');
            for($i=0;$i<count($all_events);$i++){
                $this -> Cell (self::CELL_WIDTH,self::CELL_HEIGHT,$all_events[$i],1,0,'C');
            }
        }
        function viewTable($all_characters, $all_completion, $page,$size,$current_size){
            for($i=0;$i<count($all_characters);$i++){
                $this -> Cell (self::FIRST_COLUMN_WIDTH,self::CELL_HEIGHT,$all_characters[$i][0],1,0,'C');
                for($j=0;$j<$current_size;$j++){
                    switch($all_completion[$i][$page*$size+$j]){
                        case 1:
                            $this->setFillColor(173,255,47);
                            break;
                        case "false":
                            $this->setFillColor(255,255,255);
                            break;
                        case 0:
                            $this->setFillColor(47,47,47);
                            break;
                    }
                    $this->Cell(self::CELL_WIDTH,self::CELL_HEIGHT,' ',1,0,'L',1);
                }
                $this -> Ln();
            }
        }
    }
    $pdf = new TaskTablePDF;
    $pdf -> AliasNbPages();
    $pdf -> AddPage("L","A4",0);
    $size=13;
    $all_events_chunks = array_chunk($all_events, $size);

    for($i=0;$i<count($all_events_chunks);$i++){
        $pdf -> headerTable($all_events_chunks[$i]);
        $pdf -> Ln();
        $pdf -> viewTable($all_characters, $all_completion, $i,$size,count($all_events_chunks[$i]));
        if($i!=count($all_events_chunks)-1){
            $pdf -> AddPage("L","A4",0);
        }
    }
    if(isset($_POST['update'])){
    }
    else{
        $pdf -> Output($nickname."_Таблица_Заданий_".$day.".pdf",'I', 1);
    }