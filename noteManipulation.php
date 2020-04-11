<?php
    function getCsvData($userId){
        $Names = array();
        $Math  = array();
        $Info  = array();
        $file_open = fopen("notes.csv", "r");
        $readDataAsArray = file('notes.csv'); //STORE THE CONTENT OF THE FILE IN AN ASSOCIATIVE ARRAY [EACH INDEX CONTAIN A LINE WITHIN THE CSV FILE]
        foreach ($readDataAsArray as $idUser => $record)
        {
            $buffer = explode(',', $record); //STORE EACH LINE IN AN SEPARATED ARRAY
            if ($buffer[0] == $userId)
            {
                $Names[] = trim($buffer[1]);
                $Math[]  = trim($buffer[2]);
                $Info[]  = trim($buffer[3]);
            }
        }
        return [$Names, $Math, $Info];
    }
        
    function getAllCsvdata()
    {
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
        
    function RewriteDataWithExecption($Name, $Id)
    {
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

    
    function evaluate()
    {
        for($i=0,$sum=0;$i<func_num_args();$i++)
        {
            $sum += (float)func_get_arg($i);
        }
        return $sum / func_num_args();;
    }

    function Mark($result){
        if($result < 10){
            $Mark = 'Ajournee'
            ;
        }
        else if($result >=10 && $result <12 ){
            $Mark = 'Passable';
            
        }
        else if($result >=12 && $result <14 ){
            $Mark = 'Assez bien';
        }
        else if($result >=14 && $result <16 ){
            $Mark = 'Bien';
            
        }
        else if($result >=16 && $result <20 ){
            $Mark = 'Tres bien';
            
        }     
        else $Mark = 'none';
        return $Mark;
    }
    function calculategrade($Name)
    {
        $result = 0;
        $Mark = "";
        $file_open = fopen("notes.csv", "r");
        $readDataAsArray = file('notes.csv');
        foreach ($readDataAsArray as $idUser => $record)
        {
            $buffer = explode(',', $record); //STORE EACH LINE IN AN SEPARATED ARRAY
            if ($buffer[1] == $Name)
            {
                $result = evaluate($buffer[2],$buffer[3]);
                $Mark = Mark($result);
            break; // ASSUMING THAT THE NAME IS A PRIMARY KEY
            }
        }
        return array($result, $Mark);
    } 
    if(isset($_SESSION['UserID'])){
        if(getCsvData($_SESSION['UserID'])[0] != 0){
            list($Names, $Math, $Info) = getCsvData($_SESSION['UserID']);
        }
    }
    if(isset($_POST['removeRecord'])){ // DATA GOTTEN USING AJAX IN THE CLIENT SIDE
        $Id = $_POST['userI'];
        $Name = $_POST['Name'];
        RewriteDataWithExecption($Name, $Id);
    }
    ?>