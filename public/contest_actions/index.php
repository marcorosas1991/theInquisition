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
} else if ($action == 'Start Round' || $action == 'Done') {
  // do extra verification to ensure teams and games
  $topics = getTopics();
  include 'pick_topic.php';
} else if ($action == 'show_question') {

  $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);

  if ($topic_id != NULL) {
    $question = getRandomQuestion($topic_id,5);

    if ($question != NULL) {
      $q_text = $question['question'];
      $q_id = $question['id'];

      $action = 'Show Answer';

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

  $q_id = filter_input(INPUT_POST, 'q_id', FILTER_VALIDATE_INT);

  if ($q_id != NULL) {
    $question = getQuestion($q_id);

    if ($question != NULL) {
      $q_text = $question['question'];
      $q_id = $question['id'];
      $q_answer = $question['answer'];

      $action = 'Done';

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
}

?>
