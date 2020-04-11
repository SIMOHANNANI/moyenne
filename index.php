<?php
  require("UserFormValidation.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">   
    <link rel='stylesheet' href='css/wallpaper.css'/>
    <script src="jquery/jquery.js"></script>
    <script src="https://kit.fontawesome.com/9786d4c739.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
  <div class=" container-xl  d-flex align-items-center min-vh-100 w-50 p-3">
    <form class='container-xl w-75 p-4' method="POST" action="index.php" name="form">
        <div class="input-group input-group-lg border border-dark mb-3 rounded">
          <span>
             <i class="fa fa-user-graduate fa-2x mt-2 ml-2" aria-hidden="true"></i>
          </span>
          <input type="text" class="form-control border-0 bg-transparent shadow-none font-weight-bold" id="username" placeholder="username" name = "username" value="<?php echo $_SESSION['username']?>">
        </div>
        <div class="input-group input-group-lg border border-dark mb-1 rounded">
          <span>
             <i class="fa fa-key fa-2x mt-2 ml-2" aria-hidden="true"></i>
          </span>
          <input type="password" class="form-control border-0 bg-transparent shadow-none font-weight-bold" id="password" placeholder="Password" name='password' value="<?php echo $_SESSION['password']?>">
        </div>
            <button type="button" id='cancel' class="btn btn-danger">Cancel</button>
            <button name='signin' type="submet" class="btn btn-success" name="signin">Sign in</button>
            <button name='signup' type="submet" class="btn btn-success signup" name="signup">Sign up</button>
            <?php if(FILTER_HAS_VAR(INPUT_POST,"signin") || FILTER_HAS_VAR(INPUT_POST,"signup")):?>
              <div class="container alert <?php echo $GLOBALS['class'];?>"><?php echo $GLOBALS['msg'] ;?></div>
            <?php endif ;?>
    </form>
  </div>
</body>
<script src="jsHandler.js">
    
</script>
</html>