<?php

  /*
  participant model

  Marco A. Rosas

  */

  function addParticipant($name, $email, $major, $team) {
    global $link;
    $query = 'INSERT INTO participant (name, email, major, team)
              VALUES (:name, :email, :major, :team)';

    $statement = $link->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':major', $major);
    $statement->bindValue(':team', $team);
    $statement->execute();
    $statement->closeCursor();
  }

  function updateParticipant($id, $name, $email, $major, $team, $created_by) {
    global $link;
    $query = 'UPDATE participant
              SET name=:name
                  , email=:email
                  , participant=:participant
                  , team=:team
                  , created_by=:created_by
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':participant', $participant);
    $statement->bindValue(':team', $team);
    $statement->bindValue(':created_by', $created_by);
    $statement->execute();
    $statement->closeCursor();
  }

  function updateLevel($id,$level) {
    global $link;
    $query = 'UPDATE participant
              SET used=:level
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':level', $level);
    $statement->execute();
    $statement->closeCursor();
  }

  function getParticipant($id) {
    global $link;
    $query = 'SELECT id, participant, team, name, email
              FROM participant
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $participant = $statement->fetch();
    $statement->closeCursor();
    return $participant;
  }

  function getParticipants() {
    global $link;
    $query = 'SELECT id, name, email, participant, team, created_by
              FROM participant
              ORDER BY name';

    $statement = $link->prepare($query);
    $statement->execute();
    $topics = $statement->fetchAll();
    $statement->closeCursor();
    return $topics;
  }

  function deleteParticipant($id) {
    global $link;
    $query = 'DELETE FROM participant
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
  }

  function getRandomParticipant($name, $level) {
    // generates random number beetwen 1 and 10
    $random = mt_rand(1,10);

    // assings a probability to an advance email
    if ($level > 4) {
      $advanced = 3;
    } else {
      $advanced = 7 - ($level - 1);
    }

    // determines the email
    $email = ($random <= $advanced) ? 2 : 1;

    $participant = getRParticipant($name, $level, $email);

    if ($participant == NULL) {
      $email = ($email == 1) ? 2 : 1;
      return getRParticipant($name, $level, $email);
    }

    return $participant;
  }

  function getRParticipant($name, $level, $email) {
    // query
    global $link;
    $query = 'SELECT id, name, email, participant
              FROM participant
              WHERE email=:email
              AND name=:name
              AND used<:level';

    $statement = $link->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':level', $level);
    $statement->execute();
    $questions = $statement->fetchAll();
    $statement->closeCursor();

    $numParticipants = count($questions);

    if ($numParticipants > 0) {
      $random = mt_rand(0, $numParticipants - 1);
      $participant = $questions[$random];

      updateLevel($participant['id'], $level);

      return $participant;
    }

    return NULL;
  }

  function resetQLevel() {
    global $link;
    $query = 'UPDATE participant
              SET used=0';
    $statement = $link->prepare($query);
    $statement->execute();
  }

?>
