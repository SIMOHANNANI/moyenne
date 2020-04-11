<?php
session_start();
if(!empty($_POST['Name'])){
    $userId = $_SESSION['UserID'];
    $Name = $_POST['Name'];
    $Maths = $_POST['Maths'];
    $Info = $_POST['Info'];
    if (in_array($Maths, range(0,20)) &&  in_array($Info, range(0,20))) {
        if(empty($Maths)){
            $Maths = 0;
            if(empty($Info)){
                $Info = 0;
            }
        }
        writeNewRowOnCsvFile($userId, $Name, $Maths, $Info);
    }
}

function getAllCsvdata()
{
    $Names = array();
    $Math  = array();
    $Info  = array();
    $file_open = fopen("notes.csv", "r");
    $readDataAsArray = file('notes.csv'); 
    if (trim(file_get_contents('notes.csv')) == false) {
        return ;
    }
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

function writeNewRowOnCsvFile($userid, $name, $maths, $info){
    list($UserId, $Names, $Math, $Info) = getAllCsvdata();
    $i = 0;
    if (trim(file_get_contents('notes.csv')) == true) {
        for($i = 0,$count = count($Names);$i<$count;$i++){
                $user_CSV[$i] = array($UserId[$i],$Names[$i], $Math[$i],$Info[$i]);
        }
    }
    $user_CSV[$i] = array($userid,$name, $maths,$info);
    $fp = fopen('notes.csv', 'w');
    foreach ($user_CSV as $line) {
        
        fputcsv($fp, $line, ',');
    }
    fclose($fp);
}
?>