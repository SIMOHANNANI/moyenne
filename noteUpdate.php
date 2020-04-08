<?php

if(isset($_POST['action'])){
    $Name = $_POST['Name'];
    $ID = $_POST['ID'];


}
// function updateNote(){


// }


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
        
function RewriteDataWithExecption($Name, $Id){
    list($UserId, $Names, $Math, $Info) = getAllCsvdata();
    for($i = 0,$count = count($Names);$i<$count;$i++){
        if($Names[$i] == trim($Name) && $UserId[$i] == trim($Id)){
            continue;
        }
        $user_CSV[$i] = array($UserId[$i],$Names[$i], $Math[$i],$Info[$i]);
    }
    $fp = fopen('notes.csv', 'w');
    foreach ($user_CSV as $line) {
        fputcsv($fp, $line, ',');
    }
    fclose($fp);
}

        




?>