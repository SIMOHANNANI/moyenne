<?php
  session_start(); //Start a new session for getting the user ID to get information about each user
  require("noteManipulation.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">   
        <link rel='stylesheet' href='css/wallpaper.css'/>
        <title>note</title>
        <script src="jquery/jquery.js"></script>  
        <script src="https://kit.fontawesome.com/9786d4c739.js" crossorigin="anonymous"></script>
    </head>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <i class="fas fa-user fa-2x mr-3 mb-2"></i>
  <a class="navbar-brand" href="#"><?php echo strtoupper($_SESSION['username'])?></a>
  <div class="collapse navbar-collapse ml-5" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      
        <a class="nav-link ml-5" href="#"> <span><i class="fas fa-home"></i></span> Home</a>
      </li>
    </ul>
    <button class="btn btn-secondary my-2 my-sm-0 logout-btn" type="submit"><i class="fas fa-sign-out-alt"></i></button>
  </div>
</nav>
<body>
    <div class="p-3 mb-2 bg-success text-whit" id="successMsg">
        Well done! Mr <strong><?php echo strtoupper($_SESSION['username'])?></strong> You successfully logged in <u>please provid more information to get your result !</u>.
    </div>
    <div class="container-xl d-flex align-items-center pt-5">

        <?php if(count($Names) != 0):?>
            <table class="table table-hover">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">Maths</th>
                        <th class="text-center" scope="col">Informatique</th>
                        <th class="text-center" scope="col">Moyenne</th>
                        <th class="text-center" scope="col">Mention</th>
                        <th class="text-center" scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0, $count = count($Names);$i<$count;$i++):?>
                        <form action="note.php" method="POST">
                            <tr class="table-primary">
                                <td class="text-center"><input class="update <?php echo $Names[$i]?>" type="text" value="<?php echo $Names[$i]?>" ></td>
                                <td class="text-center"><input class="update <?php echo $Names[$i]?>" type="text" value="<?php echo $Math[$i]?>" ></td>
                                <td class="text-center"><input class="update <?php echo $Names[$i]?>" type="text" value="<?php echo $Info[$i]?>" ></td>
                                <td class="text-center"><?php list($result, $Mark) = calculategrade($Names[$i]); echo $result;?></td>
                                <td class="text-center "><?php list($result, $Mark) = calculategrade($Names[$i]); echo $Mark;?></td>
                                    <td class="text-center">
                                        <button name = "removeRecord" class="btn btn-outline-danger mr-1 removeRecord" value="<?php echo $Names[$i].' '. $_SESSION['UserID']?>">
                                            <span>Delete this item</span>
                                            <i class="fas fa-eraser"> delete</i>
                                        </button>
                       
                        </form>                   
                        
                        <button name = "updateRecord" class="btn btn-outline-success ml-1 updateRecord" value="<?php echo $Names[$i].' '. $_SESSION['UserID']?>">
                            <span>Update this item</span>
                            <i class="fas fa-pen-alt"> update</i>
                        </button>
                        <button name = "saveRecord" class="btn btn-outline-success ml-1 saveRecord" value="<?php echo $Names[$i].' '. $_SESSION['UserID']?>">
                            <span>save changes</span>
                            <i class="fas fa-save"> save</i>
                        </button>
                        <button name = "cancel" class="btn btn-outline-warning ml-1 cancel" value="<?php echo $Names[$i].' '. $_SESSION['UserID']?>">
                            <span>cancel changes</span>
                            <i class="fas fa-power-off"> cancel</i>
                        
                    </button>
                                    </td>
                            </tr>            
                    <?php endfor ;?>
                </tbody>
            </table>
    </div>
    <?php endif?>
</body>
<script>
    $(document).ready(function (){
        $('.update').prop("readonly", true);
        $.fn.invisible = function() {
            return this.css('visibility', 'hidden');
        }; // Define the visibility property in CSS [Not availible in jquery]
        setTimeout(function(){
            $('#successMsg').invisible();
        },3000); 
        $(".open").click(function (){
            $(".pop-outer").fadeIn("slow");
        });
        $(".close").click(function (){
            $(".pop-outer").fadeOut("fast");
        });
        

        $('.updateRecord').click(function() {
            $(this).hide();
            $(this).siblings('.saveRecord, .cancel').show();
            var value = $(this).val();
            value = value.split(' ');
            value = value[0];
            
            $('.'+value).prop("readonly", false);


        });
        $('.cancel').click(function() {
            $(this).siblings('.updateRecord').show();
            $(this).siblings('.saveRecord').hide();
            $(this).hide();
            // $.post(ajaxurl, data);
            var value = $(this).val();
            value = value.split(' ');
            value = value[0];
            $('.'+value).prop("readonly", true);

        });
        $('.saveRecord').click(function() {
            $(this).siblings('.updateRecord').show();
            $(this).siblings('.cancel').hide();
            $(this).hide();
            var value = $(this).val();
            var functionName = $(this).attr('name');
            var ajaxurl = 'noteUpdate.php';
            value = value.split(' ');
            var Name = value[0];
            var ID = value[1];
            data = {
                'action': functionName,
                'Name': Name,
                'ID': ID};

            $.post(ajaxurl, data, function (data,status,xhr) {
                location.reload();
            });
            var value = $(this).val();
            value = value.split(' ');
            value = value[0];
            $('.'+value).prop("readonly", true);

        });
        $('.logout-btn').click(function(){
            var ajaxurl = 'logout.php';
            var data = {'logout':ajaxurl};
            $.post(ajaxurl,data,function(data,status,xhr){
                window.location.replace("index.php");
            });
        });



        // CALL THE CORRESPONDING FUNCTION IN THE PHP SERVER SIDE USING AJAX JQUERY
        // $('.insert').click(function(){
        // var clickBtnClass = $(this).attr('class');
        // alert(clickBtnClass);
        // var ajaxurl = 'resp.php',
        // data =  {'action': clickBtnClass};
        // $.post(ajaxurl, data, function (data,status,xhr) {
        //     // Response div goes here.
        //     alert(data);
        // });
        // });








    });     
</script>
</html>