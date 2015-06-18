<?php

// including model files
require_once '../../db_connection.php';
require_once '../model/topics.php';
require_once '../model/questions.php';

$link = db_link();

// getting action from post or get
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'Show Menu';
    }
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
    $topics = getTopics();
    include 'show_topics.php';
  } else {
    addTopic($topic_name);
    returnToTopics();
  }

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

  $action_str = 'Add';

  if (count($topics) > 0) {
    include 'question_form.php';
  } else {
    // a question requires a topic to be added
    $error = 'To add a question you must add a topic first.';
    $questions = getQuestions();
    include 'show_questions.php';
  }

} else if ($action == 'Add Question' || $action == 'Update Question') {
  $q_topic = filter_input(INPUT_POST, 'q_topic', FILTER_VALIDATE_INT);
  $q_difficulty = filter_input(INPUT_POST, 'q_difficulty', FILTER_VALIDATE_INT);
  $q_text = filter_input(INPUT_POST, 'q_text', FILTER_SANITIZE_STRING);
  $q_answer = filter_input(INPUT_POST, 'q_answer', FILTER_SANITIZE_STRING);

  $error = '';

  if ($q_topic == false ) {
    $error .= 'Select a valid topic.';
  }
  if ($q_difficulty == false || $q_difficulty < 1 || $q_difficulty > 2) {
    $error .= '<br>Select a valid difficulty.';
  }
  if ($q_text == false || $q_answer == false) {
    $error .= '<br>Question or answer can not be blank.';
  }

  if ($action == 'Update Question') {
    $q_id = filter_input(INPUT_POST, 'q_id', FILTER_VALIDATE_INT);
    if ($q_id == false) {
      $error .= '<br>There was a problem updating the question. Try again.';
    }
  }

  if ($error == '') {
    if ($action == 'Update Question') {
      updateQuestion($q_id,$q_topic, $q_difficulty, $q_text, $q_answer, 1);
    } else {
      addQuestion($q_topic, $q_difficulty, $q_text, $q_answer, 1);
    }

    returnToQuestions();

    $questions = getQuestions();
    include 'show_questions.php';
  } else {
    if ($action == 'Update Question') {
      $action_str = 'Update';
    } else {
      $action_str = 'Add';
    }
    $topics = getTopics();
    include 'question_form.php';
  }

} else if ($action == 'Edit Question') {
  $q_id = filter_input(INPUT_POST, 'q_id', FILTER_VALIDATE_INT);

  if ($q_id == TRUE) {
    $question = getQuestion($q_id);
    $q_text = $question['question'];
    $q_answer = $question['answer'];
    $q_topic = $question['topic'];
    $q_difficulty = $question['difficulty'];

    $action_str = 'Update';

    $topics = getTopics();

    include 'question_form.php';
  } else {
    $error = 'There was a problem selecting the question, try again.';
    $questions = getQuestions();
    include 'show_questions.php';
  }

} else if ($action == 'Delete Question') {
  $q_id = filter_input(INPUT_POST, 'q_id', FILTER_VALIDATE_INT);

  if ($q_id == TRUE) {
    deleteQuestion($q_id);
  } else {
    $error = 'There was a problem deleting the question. Try again.';
  }

  $questions = getQuestions();
  include 'show_questions.php';

} else {
  echo 'not an action';
  echo $action;
}

// these functions are to be used to prevent the user to resend data
// this avoids duplicate questions and topics
function returnToQuestions() {
  header("Location: .?action=Questions");
}

function returnToTopics() {
  header("Location: .?action=Topics");
}

?>
