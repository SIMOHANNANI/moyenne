<?php
  session_start(); // Start a new session for storing user data fro avoid retayping when he failed to sign in or up
  $GLOBALS['class'] = '';
  $GLOBALS['msg'] = '';
  $_SESSION['username'] = "";
  $_SESSION['password'] = "";
  function randomUserId() {
    $userId = '';
    $pattern = array_merge(range(0, 9), range('a', 'z'),range('A', 'Z'));
    for ($i = 0; $i < 5; $i++) {
        $userId .= $pattern[array_rand($pattern)];
    }
    return $userId;
  }

  function checkUserExistance()
  {
    $user['existence'] = 0;
    $user['username'] = $_POST['username'];
    $user['password'] = $_POST['password'];
    $user['file_open'] = fopen("Users.csv", "a");
    $user['id'] = randomUserId();
    $user['readUserAsArray'] = file('Users.csv');
    foreach ($user['readUserAsArray'] as $idUser => $record)
    {
        $buffer = explode(',', $record);
        if ($buffer[1] == $user['id'] || $buffer[1] == $user['username'])
        {
          $user['existence'] = 1;
        }
    }
  return $user;
  }

  function loginValidation()
  {
    $well = 0;
    $user = checkUserExistance();
    $password = $_POST['password'];
    if($user['existence'] == 1)
    {
      $user['readUserAsArray'] = file('Users.csv');
      foreach($user['readUserAsArray'] as $idUser => $record){
        $buffer = explode(',', $record);
        $buffer[2] = trim($buffer[2]);
        if($buffer[2] == $password){ 
          $well = 1;
          $_SESSION['UserID'] = $buffer[0]; // STORING THE ID OF USER IF FOUND FOR GET INFORMATION LATER
          break ; // IF THE PASSWORD IS CORRECT FOT THAT USER NAME SO STOP SEARCHING
        }
      }
      if($well == 1)
      {
        $GLOBALS['msg'] = 'loged in successfuly';
        $GLOBALS['class'] = 'alert-success';
        $_SESSION['loginMessage'] = true;
        header('Location:note.php');

      }
      else
      {
        $GLOBALS['msg'] = 'incorrect password';
        $GLOBALS['class'] = 'alert-danger';
      }
    }
    else
    {
      $GLOBALS['msg'] = 'User unfound';
      $GLOBALS['class'] = 'alert-danger';
      $_SESSION['username'] = "";
      $_SESSION['password'] = "";
    }
  }

  function storeNewUsers()
  {
    $user = checkUserExistance();
    if($user['username'] != "" && $user['password'] != "")
    {
      if($user['existence'] == 0)
      {
        $userData = array(
          'idUser'  => $user['id'],
          'username'  => $user['username'],
          'password'  => $user['password']
        );

        fputcsv($user['file_open'], $userData);
        $GLOBALS['msg'] = 'A new user has been registred successfuly';
        $GLOBALS['class'] = 'alert-success';
      }
      else{
        $GLOBALS['msg'] = 'username taken ! Please choose different one';
        $GLOBALS['class'] = 'alert-danger';
        $_SESSION['username'] = "";
      }
    }
    else{
      $GLOBALS['msg'] = 'empty username or password';
      $GLOBALS['class'] = 'alert-danger';
      $_SESSION['password'] = "";
    }
  }
if(FILTER_HAS_VAR(INPUT_POST,'signup') || FILTER_HAS_VAR(INPUT_POST,'signin'))
{
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['password'] = $_POST['password'];
  if (FILTER_HAS_VAR(INPUT_POST,'signup'))
  {
    storeNewUsers();
  }
  if (FILTER_HAS_VAR(INPUT_POST,'signin'))
  {

    loginValidation();
  }
}


?>