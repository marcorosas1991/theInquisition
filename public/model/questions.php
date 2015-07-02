<?php

  /*
  question model

  Marco A. Rosas

  */

  function addQuestion($topic, $difficulty, $question, $answer, $created_by) {
    global $link;
    $query = 'INSERT INTO question (topic, difficulty, question, answer, created_by)
              VALUES (:topic, :difficulty, :question, :answer, :created_by)';

    $statement = $link->prepare($query);
    $statement->bindValue(':topic', $topic);
    $statement->bindValue(':difficulty', $difficulty);
    $statement->bindValue(':question', $question);
    $statement->bindValue(':answer', $answer);
    $statement->bindValue(':created_by', $created_by);
    $statement->execute();
    $statement->closeCursor();
  }

  function updateQuestion($id, $topic, $difficulty, $question, $answer, $created_by) {
    global $link;
    $query = 'UPDATE question
              SET topic=:topic
                  , difficulty=:difficulty
                  , question=:question
                  , answer=:answer
                  , created_by=:created_by
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':topic', $topic);
    $statement->bindValue(':difficulty', $difficulty);
    $statement->bindValue(':question', $question);
    $statement->bindValue(':answer', $answer);
    $statement->bindValue(':created_by', $created_by);
    $statement->execute();
    $statement->closeCursor();
  }

  function updateLevel($id,$level) {
    global $link;
    $query = 'UPDATE question
              SET used=:level
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':level', $level);
    $statement->execute();
    $statement->closeCursor();
  }

  function getQuestion($id) {
    global $link;
    $query = 'SELECT id, question, answer, topic, difficulty
              FROM question
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $question = $statement->fetch();
    $statement->closeCursor();
    return $question;
  }

  function getQuestions() {
    global $link;
    $query = 'SELECT id, topic, difficulty, question, answer, created_by
              FROM question
              ORDER BY topic';

    $statement = $link->prepare($query);
    $statement->execute();
    $topics = $statement->fetchAll();
    $statement->closeCursor();
    return $topics;
  }

  function deleteQuestion($id) {
    global $link;
    $query = 'DELETE FROM question
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
  }

  function getQuestionSearch($search_str) {
    global $link;
    $query = 'SELECT q1.id, q1.question, q1.answer, q1.topic, q1.difficulty
              FROM question q1
              WHERE q1.question LIKE :search_str';

    $statement = $link->prepare($query);
    $statement->bindValue(':search_str', '%'.$search_str.'%');
    $statement->execute();
    $questions = $statement->fetchAll();
    $statement->closeCursor();
    return $questions;
  }

  function getRandomQuestion($topic, $level) {
    // generates random number beetwen 1 and 10
    $random = mt_rand(1,10);

    // assings a probability to an advance difficulty
    if ($level > 4) {
      $advanced = 3;
    } else {
      $advanced = 7 - ($level - 1);
    }

    // determines the difficulty
    $difficulty = ($random <= $advanced) ? 2 : 1;

    $question = getRQuestion($topic, $level, $difficulty);

    if ($question == NULL) {
      $difficulty = ($difficulty == 1) ? 2 : 1;
      return getRQuestion($topic, $level, $difficulty);
    }

    return $question;
  }

  function getRQuestion($topic, $level, $difficulty) {
    // query
    global $link;
    $query = 'SELECT id, topic, difficulty, question
              FROM question
              WHERE difficulty=:difficulty
              AND topic=:topic
              AND used<:level';

    $statement = $link->prepare($query);
    $statement->bindValue(':difficulty', $difficulty);
    $statement->bindValue(':topic', $topic);
    $statement->bindValue(':level', $level);
    $statement->execute();
    $questions = $statement->fetchAll();
    $statement->closeCursor();

    $numQuestions = count($questions);

    if ($numQuestions > 0) {
      $random = mt_rand(0, $numQuestions - 1);
      $question = $questions[$random];

      updateLevel($question['id'], $level);

      return $question;
    }

    return NULL;
  }

  function resetQLevel() {
    global $link;
    $query = 'UPDATE question
              SET used=0';
    $statement = $link->prepare($query);
    $statement->execute();
  }

?>
