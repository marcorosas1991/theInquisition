<?php

require_once '../db_connection.php';

require_once 'model/session.php';
require_once 'model/users.php';

$link = db_link();

$action = filter_input(INPUT_POST, 'action');
if (!isset($action)) {
  $action = 'login_page';
}

if ($action == 'login_page') {
  include 'login.php';
} else if ($action == 'login') {

  $usr = filter_input(INPUT_POST, 'username');
  $pass = filter_input(INPUT_POST, 'password');

  if ($usr != NULL && $pass != NULL) {
    $user = getUser($usr,$pass);

    if(count($user) > 1) {
      session_start();
      $_SESSION['user']=$user['username'];
      $_SESSION['user_id']=$user['id'];
      $_SESSION['userType'] = $user['userType'];
      $userType = $user['userType'];

      switch ($userType) {
        // user is admin
        case 0:
          header('Location: admin_actions/.');
          exit();
          break;
        case 1:
          break;
        case 2:
          header('Location: contest_actions/.');
          break;
        case 3:
          break;
        default:
          echo 'not a valid user';
      }
    } else {
      $error = 'invalid username or password';
    }

  } else {
    $error = 'username/password are blank';
  }

  include 'login.php';
}

?>
