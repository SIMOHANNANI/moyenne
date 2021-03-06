<?php

if(isset($_POST['save'])){
    $ID = $_POST['ID'];
    $Name = $_POST['Name'];
    $Math = $_POST['Math'];
    $Info = $_POST['Info'];
    $fieldName = $_POST['fieldName'];
    if (in_array($Maths, range(0,20)) &&  in_array($Info, range(0,20))) {
        if(empty($Maths)){
            $Maths = 0;
            if(empty($Info)){
                $Info = 0;
            }
        }   
    updateNote($ID, $Name, $fieldName,  $Math, $Info);
    }
}

function getAllCsvdata(){
    $Names = array();
    $Math  = array();
    $Info  = array();
    $file_open = fopen("notes.csv", "r");
    $readDataAsArray = file('notes.csv'); 
    foreach ($readDataAsArray as $idUser => $record)
    {
        $buffer = explode(',', $record);
        $UserId[] = trim($buffer[0]);
        $Names[] = trim($buffer[1]);
        $Math[]  = trim($buffer[2]);
        $Info[]  = trim($buffer[3]);
    }
    fclose($file_open);
    return [$UserId, $Names, $Math, $Info];
}
        
function updateNote($id,$name,$rep_name ,$math, $info){
    $j = 1;
    list($UserId, $Names, $Math, $Info) = getAllCsvdata();
    for($i = 0,$count = count($Names);$i<$count;$i++){
        if($Names[$i] == trim($name) && $UserId[$i] == trim($id)){
            $user_CSV[$i] = array($UserId[$i],$rep_name, $math,$info);
            echo "updated";
        }
        else{
            $user_CSV[$i] = array($UserId[$i],$Names[$i], $Math[$i],$Info[$i]);
        }
    }
    $fp = fopen('notes.csv', 'w');
    foreach ($user_CSV as $line) {
        fputcsv($fp, $line, ',');
    }
    fclose($fp);
}
?>