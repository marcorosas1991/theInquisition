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

  function updateParticipant($id, $name, $email, $major, $team) {
    global $link;
    $query = 'UPDATE participant
              SET name=:name
                  , email=:email
                  , major=:major
                  , team=:team
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':major', $major);
    $statement->bindValue(':team', $team);
    $statement->execute();
    $statement->closeCursor();
  }

  function getParticipant($id) {
    global $link;
    $query = 'SELECT id, name, email, major, team
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
    $query = 'SELECT id, name, email, major, team
              FROM participant
              ORDER BY team';

    $statement = $link->prepare($query);
    $statement->execute();
    $topics = $statement->fetchAll();
    $statement->closeCursor();
    return $topics;
  }

  function getParticipantsForTeam($team) {
    global $link;
    $query = 'SELECT id, name, email, major, team
              FROM participant
              WHERE team=:team';

    $statement = $link->prepare($query);
    $statement->bindValue(':team', $team);
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

?>
