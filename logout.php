<?php

function logout(){
    session_destroy()

}
if($_POST['logout']){
    echo "ho";
    logout();

}





?>