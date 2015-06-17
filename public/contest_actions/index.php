<?php

if (!isset($action)) {
  $action = 'Start Contest';
}

if ($action == 'Start Contest') {
  include 'start.php';
} else if ($action == 'pickTopic') {
  include 'pick.php';
} else if ($action == 'showAnswer') {
  include 'show.php';
}

?>
