<?php
  /*
  teams model
  Marco A. rosas
  */
  function addTeam($name) {
    global $link;
    $query = 'INSERT INTO team (name)
              VALUES (:name)';
    $statement = $link->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
  }
  function updateTeam($id, $name) {
    global $link;
    $query = 'UPDATE team
              SET name=:name
              WHERE id=:id';
    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
  }
  function getTeam($id) {
    global $link;
    $query = 'SELECT id, name
              FROM team
              WHERE id=:id';
    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $team = $statement->fetch();
    $statement->closeCursor();
    return $team;
  }
  function getTeams() {
    global $link;
    $query = 'SELECT id, name
              FROM team
              ORDER BY name';
    $statement = $link->prepare($query);
    $statement->execute();
    $teams = $statement->fetchAll();
    $statement->closeCursor();
    return $teams;
  }
  function deleteTeam ($id) {
    global $link;
    $query = 'DELETE FROM team
              WHERE id=:id';
    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
  }
?>
