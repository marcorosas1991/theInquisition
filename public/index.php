<?php

if (!isset($action)) {
  $action = 'login';
}

if ($action == 'login') {
  include 'login.php';
}

?>
