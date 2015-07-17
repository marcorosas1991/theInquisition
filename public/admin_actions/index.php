<?php

// including model files
require_once '../../db_connection.php';
require_once '../model/topics.php';
require_once '../model/questions.php';
require_once '../model/teams.php';
require_once '../model/participants.php';
require_once '../model/users.php';

require_once '../model/session.php';

startSession();
validateSession();

$link = db_link();
$log_out_in_menu = TRUE;
$userType = $_SESSION['userType'];

if ($_SESSION['userType'] != 0) {
  header('Location: ../.');
  exit();
}

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
// ************ TOPIC ACTIONS
// shows topics
else if ($action == 'Topics') {
  showTopics();
}
// add topic
else if ($action == 'Add Topic') {
  $topic_name = filter_input(INPUT_POST, 'topic_name');
  // makes sure topic name is not empty
  if ($topic_name == NULL) {
    $error = 'You must provide a topic name.';
    showTopics($error);
  } else {
    addTopic($topic_name);
    returnToTopics();
  }

}
// edit topic
else if ($action == 'Edit Topic') {
  $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);

  if ($topic_id == TRUE) {
    $topic = getTopic($topic_id);
    $topic_name = $topic['name'];
    include 'topic_form.php';
  } else {
    $error ='Select the topic again';
    showTopics($error);
  }
}
// update topic
else if ($action == 'Update Topic') {
  $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);
  $topic_name = filter_input(INPUT_POST, 'topic_name');

  if ($topic_id == TRUE && $topic_name == TRUE) {
    updateTopic($topic_id, $topic_name);
    $error = '';
  } else {
    $error ='There was a problem UPDATING the topic. Try again.';
  }
  showTopics($error);
}
// delete topic
else if ($action == 'Delete Topic') {
  $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_VALIDATE_INT);

  if ($topic_id == TRUE) {
    deleteTopic($topic_id);
    $error = '';
  } else {
    $error ='There was a problem DELETING the topic. Try again.';
  }
  showTopics($error);
}

// ************ QUESTION ACTIONS
// show Questions
else if ($action == 'Questions') {
  showQuestions();
}
else if ($action == 'search_questions') {
  $search_str = filter_input(INPUT_POST, 'search_str');
  $error = '';
  showQuestions($error, $search_str);
}
// show question form
else if ($action == 'add_question') {

  $topics = getTopics();
  $action_str = 'Add';

  if (count($topics) > 0) {
    include 'question_form.php';
  } else {
    // a question requires a topic to be added
    $error = 'To add a question you must add a topic first.';
    showQuestions($error);
  }

}
// adding or updating a question
else if ($action == 'Add Question' || $action == 'Update Question') {

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
      $error .= '<br>There was a problem UPDATING the question. Try again.';
    }
  }

  if ($error == '') {
    if ($action == 'Update Question') {
      updateQuestion($q_id,$q_topic, $q_difficulty, $q_text, $q_answer, 1);
    } else {
      addQuestion($q_topic, $q_difficulty, $q_text, $q_answer, 1);
    }

    returnToQuestions();

  } else {
    if ($action == 'Update Question') {
      $action_str = 'Update';
    } else {
      $action_str = 'Add';
    }
    $topics = getTopics();
    include 'question_form.php';
  }

}
// edit question
else if ($action == 'Edit Question') {
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
    showQuestions($error);
  }

}
// delete questions
else if ($action == 'Delete Question') {
  $q_id = filter_input(INPUT_POST, 'q_id', FILTER_VALIDATE_INT);

  if ($q_id == TRUE) {
    deleteQuestion($q_id);
    $error = '';
  } else {
    $error = 'There was a problem DELETING the question. Try again.';
  }
  showQuestions($error);

}

// ************ TEAM ACTIONS
// show teams
else if ($action == 'Teams') {
  showTeams();
}
// add a team
else if ($action == 'Add Team') {
  $team_name = filter_input(INPUT_POST, 'team_name');
  if ($team_name == NULL) {
    $error = 'You must provide a team name.';
    showTeams($error);
  } else {
    addTeam($team_name);
    returnToTeams();
  }
}
// edit a team
else if ($action == 'Edit Team') {
  $team_id = filter_input(INPUT_POST, 'team_id', FILTER_VALIDATE_INT);
  $error = '';

  if ($team_id == TRUE) {
    showTeam($error, $team_id);
  } else {
    $error ='Select the team again';
    showTeams($error);
  }
}
// update team
else if ($action == 'Update Team Name') {
  $team_id = filter_input(INPUT_POST, 'team_id', FILTER_VALIDATE_INT);
  $team_name = filter_input(INPUT_POST, 'team_name');

  if ($team_id == TRUE && $team_name == TRUE) {
    updateTeam($team_id, $team_name);
    showTeams();
  } else {
    $error ='There was a problem UPDATING the team. Try again.';
    showTeams($error);
  }

}
// delete team
else if ($action == 'Delete Team') {
  $team_id = filter_input(INPUT_POST, 'team_id', FILTER_VALIDATE_INT);

  if ($team_id == TRUE) {
    deleteTeam($team_id);
    showTeams();
  } else {
    $error ='There was a problem DELETING the team. Try again.';
    showTeams($error);
  }
}

// ************ PARTICIPANT ACTIONS
else if ($action == 'Participants') {
  showParticipants();
}
// add participant
else if ($action == 'add_participant') {
  $team_id = filter_input(INPUT_POST, 'team_id', FILTER_VALIDATE_INT);

  if ($team_id == TRUE) {
    $team = getTeam($team_id);
    $action_str = 'Add';
    include 'participant_form.php';
  } else {
    $error ='Please try again';
    showTeams($error);
  }
}
// insert participant OR update participant
else if ($action == 'Add Participant' || $action == 'Update Participant') {
  $p_id = filter_input(INPUT_POST, 'p_id', FILTER_VALIDATE_INT);

  $p_team = filter_input(INPUT_POST, 'p_team', FILTER_VALIDATE_INT);
  $p_name = filter_input(INPUT_POST, 'p_name', FILTER_SANITIZE_STRING);
  $p_email = filter_input(INPUT_POST, 'p_email', FILTER_SANITIZE_EMAIL);
  $p_major = filter_input(INPUT_POST, 'p_major', FILTER_SANITIZE_STRING);
  $error = '';

  // makes sure participant name is not empty
  if ($p_name == NULL) {
    $error .= 'You must provide a participant name.';
  }
  // if there are not errors
  if ($error == '') {
    if ($action == 'Update Participant') {
      updateParticipant($p_id, $p_name, $p_email, $p_major, $p_team);
    } else {
      addParticipant($p_name, $p_email, $p_major, $p_team);
    }
    showTeam($error, $p_team);
  } else {
    $team = getTeam($p_team);
    $action_str = $action == 'Add Participant' ? 'Add' : 'Update';
    include 'participant_form.php';
  }
}
// edit participant
else if ($action == 'Edit Participant') {
  $p_id = filter_input(INPUT_POST, 'p_id', FILTER_VALIDATE_INT);

  if ($p_id == TRUE) {
    $participant = getParticipant($p_id);
    $p_team = $participant['team'];
    $p_name = $participant['name'];
    $p_email = $participant['email'];
    $p_major = $participant['major'];

    $team = getTeam($p_team);
    $action_str = 'Update';

    include 'participant_form.php';

  } else {
    $error ='Select the team and participant again';
    showTeams($error);
  }
}
// delete participant
else if ($action == 'Delete Participant') {
  $p_id = filter_input(INPUT_POST, 'p_id', FILTER_VALIDATE_INT);

  if ($p_id == TRUE) {
    deleteParticipant($p_id);
    $error = '';
  } else {
    $error ='There was a problem DELETING the participant. Try again.';
  }
  showTeams($error);
}

// USER ACTIONS
// add user
else if ($action == 'Users') {
  $users = getUsers();
  include 'show_users.php';
}

//insert user
else if ($action == 'Add User') {
  $username = filter_input(INPUT_POST, 'username');
  $password = filter_input(INPUT_POST, 'password');

  $error = '';

  if ($username == FALSE || $password == FALSE) {
    $error = 'Username or Password can not be blank';
    $users = getUsers();
    include 'show_users.php';
  } else {
    addUser($username, $password, 2);
    header('Location: .?action=Users');
  }

}

//delete user
else if ($action == 'Delete User') {
  $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

  if ($user_id != FALSE) {
    if ($user_id != 4) {
      deleteUser($user_id);
    }
  }

  header('Location: .?action=Users');

}





// START CONTEST ACTIONS
elseif ($action == 'Start A Game') {
  header('Location: ../contest_actions/');
}

// ************ ELSE ACTIONS
else {
  session_destroy();
  header("Location: ../.");
}

// these functions are to be used to prevent the user to resend data
// this avoids duplicate questions and topics
// post/redirect/get
function returnToQuestions() {
  header("Location: .?action=Questions");
}

function returnToTopics() {
  header("Location: .?action=Topics");
}

function returnToTeams() {
  header("Location: .?action=Teams");
}

// functions to load the corresponding views
function showTopics($errors = '') {
  $error = $errors;
  $topics = getTopics();
  include 'show_topics.php';
}

function showQuestions($errors = '', $search_str = '')
{
  $error = $errors;

  if ($search_str != '') {
    $questions = getQuestionSearch($search_str);
    $search_inst = TRUE;
  } else {
    $questions = getQuestions();
  }

  $topics = getTopics();
  foreach ($topics as $topic) {
    $topics_names[$topic['id']] = $topic['name'];
  }
  include 'show_questions.php';
}

function showTeams($errors = '') {
  $error = $errors;
  $teams = getTeams();
  $participants = array();

  foreach ($teams as $team) {
    $participants[] = getParticipantsForTeam($team['id']);
  }

  include 'show_teams.php';
}

function showTeam($errors = '', $team_id) {
  $team = getTeam($team_id);
  $team_name = $team['name'];
  $participants = getParticipantsForTeam($team_id);
  include 'team_form.php';
}



?>
