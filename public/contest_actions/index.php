<?php

require_once '../../db_connection.php';
require_once '../model/topics.php';
require_once '../model/questions.php';
require_once '../model/teams.php';
require_once '../model/session.php';

startSession();
validateSession();

$link = db_link();

$action = filter_input(INPUT_POST, 'action');
if ($action == FALSE) {
  $action = 'choose_teams';

  if( isset($_SESSION['gameStarted'] )) {
    $action = 'Start';
  }
}

if ($action == 'choose_teams') {

  $log_out_in_menu = TRUE;

  if (isset($_SESSION['teams_in_game'])) {
    $teams_in_game = $_SESSION['teams_in_game'];
  }

  $teams = getTeams();
  include 'choose_teams.php';
} else if ($action == '+'){

  if (isset($_SESSION['teams_in_game'])) {
    $teams_in_game = $_SESSION['teams_in_game'];
  } else {
    $teams_in_game = array();
  }

  $new_team_id = filter_input(INPUT_POST, 'team_id', FILTER_VALIDATE_INT);

  if ($new_team_id != FALSE) {
    $team = array();
    $team['name'] = getTeam($new_team_id)['name'];
    $team['score'] = 0;
    $teams_in_game[$new_team_id] = $team;
  }

  $_SESSION['teams_in_game'] = $teams_in_game;


  header('Location: .');
}

// remove team from team list for game
else if ($action == 'Remove Team') {
  echo 'remove action';

  if (isset($_SESSION['teams_in_game'])) {
    $teams_in_game = $_SESSION['teams_in_game'];
    $team_id = filter_input(INPUT_POST, 'team_id', FILTER_VALIDATE_INT);

    if ($team_id !== FALSE) {
      unset($teams_in_game[$team_id]);
      $_SESSION['teams_in_game'] = $teams_in_game;
    }
  }

  header('Location: .');

} else if ($action == 'Start') {

  $_SESSION['gameStarted'] = true;
  $teams_in_game = $_SESSION['teams_in_game'];

  $topics = getTopics();
  include 'pick_topic.php';
} else if ($action == 'Done') {
  if (isset($_POST['points_to'])) {

    $points_to = $_POST['points_to'];

    $teams_in_game = $_SESSION['teams_in_game'];
    foreach ($points_to as $t_id) {
      $teams_in_game[$t_id]['score'] += 1;
      $_SESSION['teams_in_game'] = $teams_in_game;
    }
  }

  header('Location: .');
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

  if (isset($_SESSION['teams_in_game'])) {
    $teams_in_game = $_SESSION['teams_in_game'];
  }

  $topics = getTopics();
  include 'pick_topic.php';

} else if ($action == 'Show Answer') {

  $q_id = filter_input(INPUT_POST, 'q_id', FILTER_VALIDATE_INT);

  if ($q_id != NULL) {

    if (isset($_SESSION['teams_in_game'])) {
      $teams_in_game = $_SESSION['teams_in_game'];
    }

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
} else if ($action == 'Finish Game') {

  if (isset($_SESSION['teams_in_game'])) {
    $teams_in_game = $_SESSION['teams_in_game'];

    //checks that there is not a tie
    $error = '';
    $max_score = -1;
    $winner;
    foreach ($teams_in_game as $t_id => $team) {
      if ($max_score == $team['score']) {
        $error = 'Break the tie to finish the game';
      }

      if ($max_score < $team['score']) {
        $max_score = $team['score'];
        $winner = $t_id;
      }
    }

    if ($error == '') {
      $log_out_in_menu = TRUE;
      
      //unset($_SESSION['teams_in_game']);
      unset($_SESSION['gameStarted']);
      include 'scores.php';
    } else {
      $topics = getTopics();
      include 'pick_topic.php';
    }
  } else {
    header('Location: .');
  }

}

?>
