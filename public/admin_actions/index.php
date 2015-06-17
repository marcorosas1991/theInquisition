<?php

require_once '../../db_connection.php';
require '../model/topics.php';
require '../model/questions.php';

$link = db_link();

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
  $action = 'Show Menu';
}

if ($action == 'Show Menu') {
  include 'show_menu.php';
}
// Topic actions
else if ($action == 'Topics') {
  $topics = getTopics();
  include 'show_topics.php';
} else if ($action == 'Add Topic') {
  $topic_name = filter_input(INPUT_POST, 'topic_name');
  if ($topic_name == NULL) {
    $error = 'You must provide a topic name.';
  } else {
    addTopic($topic_name);
  }
  $topics = getTopics();
  include 'show_topics.php';
} else if ($action == 'Edit Topic') {
  $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);

  if ($topic_id == TRUE) {
    $topic = getTopic($topic_id);
    $topic_name = $topic['name'];
    include 'topic_form.php';
  } else {
    $error ='Select the topic again';
    $topics = getTopics();
    include 'show_topics.php';
  }
} else if ($action == 'Update Topic') {
  $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);
  $topic_name = filter_input(INPUT_POST, 'topic_name');

  if ($topic_id == TRUE && $topic_name == TRUE) {
    updateTopic($topic_id, $topic_name);
    $topics = getTopics();
    include 'show_topics.php';
  } else {
    $error ='There was a problem updating the topic. Try again.';
    $topics = getTopics();
    include 'show_topics.php';
  }
} else if ($action == 'Delete Topic') {
  $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);

  if ($topic_id == TRUE) {
    deleteTopic($topic_id);
    $topics = getTopics();
    include 'show_topics.php';
  } else {
    echo 'false, no int';
  }
}

// Question actions
else if ($action == 'Questions') {
  $questions = getQuestions();
  include 'show_questions.php';
} else if ($action == '+') {

  $topics = getTopics();
  if (count($topics) > 0) {
    $question = '';
    $answer = '';
    include 'question_form.php';
  } else {
    // a question requires a topic to be added
    $error = 'To add a question you must add a topic first.';
    $questions = getQuestions();
    include 'show_questions.php';
  }

} else if ($action == 'Add Question') {
  $q_topic = filter_input(INPUT_POST, 'q_topic', FILTER_VALIDATE_INT);
  $q_difficulty = filter_input(INPUT_POST, 'q_difficulty', FILTER_VALIDATE_INT);
  $question = filter_input(INPUT_POST, 'question', FILTER_SANITIZE_STRING);
  $answer = filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_STRING);

  $error = '';

  if ($q_topic == false ) {
    $error .= 'Select a valid topic.';
  }
  if ($q_difficulty == false || $q_difficulty < 1 || $q_difficulty > 2) {
    $error .= '<br>Select a valid difficulty.';
  }
  if ($question == false || $answer == false) {
    $error .= '<br>Question or answer can not be blank.';
  }

  if ($error == '') {
    addQuestion($q_topic, $q_difficulty, $question, $answer, 1);
    $questions = getQuestions();
    include 'show_questions.php';
  } else {
    $topics = getTopics();
    include 'question_form.php';
  }
} else if ($action == 'Edit Question2') {
  $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);

  if ($topic_id == TRUE) {
    $topic = getTopic($topic_id);
    $topic_name = $topic['name'];
    include 'topic_form.php';
  } else {
    echo 'false, no int';
  }
} else if ($action == 'Update Question2') {
  $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);
  $topic_name = filter_input(INPUT_POST, 'topic_name');

  if ($topic_id == TRUE && $topic_name == TRUE) {
    updateTopic($topic_id, $topic_name);
    $topics = getTopics();
    include 'show_topics.php';
  } else {
    echo 'false, no int, no name';
  }
} else if ($action == 'Delete Question') {
  $q_id = filter_input(INPUT_POST, 'q_id', FILTER_VALIDATE_INT);

  if ($q_id == TRUE) {
    deleteQuestion($q_id);
    $questions = getQuestions();
    include 'show_questions.php';
  } else {
    echo 'false, no int';
  }
} else {
  echo 'not an action';
  echo $action;
}

?>
