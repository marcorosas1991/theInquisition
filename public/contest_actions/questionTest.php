<?php

require_once '../model/questions.php';

require_once '../../db_connection.php';
$link = db_link();

resetQLevel();

for ($i=1; $i < 8; $i++) {
  echo "<br><br><b>$i</b>";
  for ($j = 0; $j < 10; $j++) {

    $question = getRandomQuestion($i,5);

    if ($question != NULL) {
      $text = $question['question'];
      $id = $question['id'];
      $topic = $question['topic'];
      echo "<br>$id $text, $topic";
    } else {
      echo "<br>NULL";
    }
  }
}

resetQLevel();

?>
