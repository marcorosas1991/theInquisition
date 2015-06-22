<?php

require_once '../../db_connection.php';
require_once '../model/topics.php';
require_once '../model/questions.php';
require_once '../model/session.php';

validateSession();

$link = db_link();

$action = filter_input(INPUT_POST, 'action');
if (!isset($action)) {
  $action = 'show_games';
}

if ($action == 'show_games') {
  include 'show_games.php';
} else if ($action == 'Start Contest') {
  // do extra verification to ensure teams and games
  $topics = getTopics();
  include 'pick_topic.php';
} else if ($action == 'show_question') {

  $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);

  if ($topic_id != NULL) {
    $question = getRandomQuestion($topic_id,5);

    if ($question != NULL) {
      $q_text = $question['question'];
      include 'show_question.php';
      exit();
    } else {
      $error = 'No more questions. Pick another topic.';
    }
  } else {
    $error = 'Pick a topic again';
  }

  $topics = getTopics();
  include 'pick_topic.php';

} else if ($action == 'Show Answer') {
  echo 'show answer';
  include 'show.php';
}

?>
