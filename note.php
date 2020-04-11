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
        <a class="nav-link ml-5" href="#">
            <span>
                <i class="fas fa-home"></i>
            </span> Home
        </a>
      </li>
    </ul>
    <button class="btn btn-secondary my-2 my-sm-0 logout-btn" type="submit"><i class="fas fa-sign-out-alt"></i></button>
  </div>
</nav>
<body>
<?php if(isset($_SESSION['loginMessage'])):?>
    <div class="p-3 mb-2 bg-success text-whit" id="successMsg">
        Well done! Mr <strong><?php echo strtoupper($_SESSION['username'])?></strong> You successfully logged in .
    </div>
    <?php  unset($_SESSION['loginMessage']);?>
<?php endif?>
    <div class="container-xl d-flex align-items-center pt-5">
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
            <?php if(count($Names) != 0):?>
                <tbody>
                    <?php for($i=0, $count = count($Names);$i<$count;$i++):?>
                        <tr class="table-primary">
                            <td class="text-center"><input class="update Name <?php echo $Names[$i]?>" type="text" value="<?php echo $Names[$i]?>" ></td>
                            <td class="text-center"><input class="update Math <?php echo $Names[$i]?>" type="text" value="<?php echo $Math[$i]?>" ></td>
                            <td class="text-center"><input class="update Info <?php echo $Names[$i]?>" type="text" value="<?php echo $Info[$i]?>" ></td>
                            <td class="text-center"><?php list($result, $Mark) = calculategrade($Names[$i]); echo $result;?></td>
                            <td class="text-center "><?php list($result, $Mark) = calculategrade($Names[$i]); echo $Mark;?></td>
                            <td class="text-center">
                                <button class="btn btn-outline-danger mr-1 removeRecord <?php echo $Names[$i].' '. $_SESSION['UserID']?>" value="<?php echo $Names[$i].' '. $_SESSION['UserID']?>">
                                    <span>Delete this item </span>
                                    <i class="fas fa-eraser"> delete </i>
                                </button>
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
            <?php endif?>
            <tr class="table-primary NewRow">
                <td class="text-center"><input class="New NewName" type="text" placeholder = "student name"></td>
                <td class="text-center"><input class="New NewMath" type="text" placeholder = "maths grade"></td>
                <td class="text-center"><input class="New NewInfo" type="text" placeholder = "info grade"></td>
                <td class="text-center"></td>
                <td class="text-center "></td>
                <td class="text-center">
                    <button class="btn btn-outline-success mr-4 NewSave">
                        <span>save as new item</span>
                        <i class="fas  fa-save"> save</i>
                    </button>
                    <button class="btn btn-outline-warning ml-1 NewCancel">
                        <span>cancel new item</span>
                        <i class="fas  fa-power-off">  cancel</i>
                    </button>
                </td>
            </tr>            
        </table>
    </div>
    <div class="container NewStudent">
        <button type="button" class="btn btn-outline-success text-dark float-right AddStudent">
            <i class="fas  fa-user-plus"> Add student</i> 
        </button>
    </div>
</body>
<script src="jsHandler.js"></script>
</html>