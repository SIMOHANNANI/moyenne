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
<body>
    <div class="p-3 mb-2 bg-success text-whit" id="successMsg">
        Well done! Mr <strong><?php echo strtoupper($_SESSION['username'])?></strong> You successfully logged in <u>please provid more information to get your result !</u>.
    </div>
    <div class="container-xl d-flex align-items-center pt-5">
        <!-- <form class='container-xl w-75 p-4'>
            <div class="form-group">
                <label for="staticEmail"  class="col-sm-2 col-form-label">Nom</label>
                <input type="text" class="form-control" id="Nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Prenom</label>
                <input type="text" class="form-control" id="Prenom" placeholder="prenom">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Maths</label>
                <input type="number" class="form-control" id="Maths" placeholder="note de maths"  min="0" max="20">
                <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Informatique</label>
                <input type="number" class="form-control" id="Informatique" placeholder="note d'informatique"   min="0" max="20">
            </div>
        </form> -->

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
                                <td class="text-center"><input class="update" type="text" value="<?php echo $Names[$i]?>" readonly></td>
                                <td class="text-center"><input class="update" type="text" value="<?php echo $Math[$i]?>" readonly></td>
                                <td class="text-center"><input class="update" type="text" value="<?php echo $Info[$i]?>" readonly></td>
                                <td class="text-center"><input class="update" type="text" value="<?php list($result, $Mark) = calculategrade($Names[$i]); echo $result;?>" readonly></td>
                                <td class="text-center "><input class="update" type="text" value="<?php list($result, $Mark) = calculategrade($Names[$i]); echo $Mark;?>" readonly></td>
                                    <td class="text-center">
                                        <button name = "removeRecord" class="btn btn-outline-danger mr-1" value="<?php echo $Names[$i].' '. $_SESSION['UserID']?>">
                                            <span>Delete this item</span>
                                            <i class="fas fa-eraser"> delete</i>
                                        </button>
                                        <button name = "removeRecord" class="btn btn-outline-primary ml-1" value="<?php echo $Names[$i].' '. $_SESSION['UserID']?>">
                                            <span>Update this item</span>
                                            <i class="fas fa-pen-alt"> update</i>
                                        </button>
                                    </td>
                            </tr>            
                        </form>
                    <?php endfor ;?>
                </tbody>
            </table>
    </div>
    <?php endif?>
    <div class='container-xl w-75 p-4'>
        <button id='annuler' class="alert alert-danger">Log out</button>
    </div>
</body>
<script>
    function result(){
        var Maths = document.getElementById('Maths').value;
        var Informatique = document.getElementById('Informatique').value;
        Maths = parseInt(Maths,10);
        Informatique = parseInt(Informatique,10);
        result = (Maths + Informatique)/2;
        document.getElementById('NOM').innerHTML = document.getElementById('Nom').value;;
        document.getElementById('PRENOM').innerHTML = document.getElementById('Prenom').value;
        if((Maths <= 20 && Maths >=0) && (Informatique <= 20 && Informatique >=0))
        {
            if(result < 10){
                document.getElementById('MENTION').innerHTML = 'Ajournee';
            }
            else if(result >=10 && result <12 ){
                document.getElementById('MENTION').innerHTML = 'Passable';

            }
            else if(result >=12 && result <14 ){
                document.getElementById('MENTION').innerHTML = 'Assez bien';
            }
            else if(result >=14 && result <16 ){
                document.getElementById('MENTION').innerHTML = 'Bien';

            }
            else if(result >=16 && result <20 ){
                document.getElementById('MENTION').innerHTML = 'Tres bien';

            }     
            else document.getElementById('MENTION').innerHTML = 'none';
        }
        else{
            document.getElementById('MENTION').innerHTML = 'Grade doesn\'t exist ! Please try again';
        }
        document.getElementById('MATHS').innerHTML = document.getElementById('Maths').value;
        document.getElementById('INFORMATIQUE').innerHTML = document.getElementById('Informatique').value;
        document.getElementById('RESULTAT').innerHTML = result;
    }
    $(document).ready(function (){
        $.fn.invisible = function() {
            return this.css('visibility', 'hidden');
        }; // Define the visibility function [Not availible in jquery]
        setTimeout(function(){
            $('#successMsg').invisible();
        },3000); 
        $(".open").click(function (){
            $(".pop-outer").fadeIn("slow");
        });
        $(".close").click(function (){
            $(".pop-outer").fadeOut("fast");
        });
    });     
</script>
</html>