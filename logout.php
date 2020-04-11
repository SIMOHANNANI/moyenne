<?php

function logout(){
    session_destroy()

}
if($_POST['logout']){
    logout();
}

?>