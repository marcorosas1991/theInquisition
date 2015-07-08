<?php
  /*
  teams model
  Marco A. rosas
  */
  function addGame($created_by, $creation_time) {
    global $link;
    $query = 'INSERT INTO game (created_by, creation_time)
              VALUES (:created_by, :creation_time)';
    $statement = $link->prepare($query);
    $statement->bindValue(':created_by', $created_by);
    $statement->bindValue(':creation_time', $creation_time);
    $statement->execute();
    $statement->closeCursor();
  }
  function updateGame($id, $winner) {
    global $link;
    $query = 'UPDATE game
              SET winner=:winner
              WHERE id=:id';
    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':winner', $winner);
    $statement->execute();
    $statement->closeCursor();
  }
  function getGame($id) {
    global $link;
    $query = 'SELECT id, winner, created_by
              FROM game
              WHERE id=:id';
    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $game = $statement->fetch();
    $statement->closeCursor();
    return $game;
  }
  function getGameNatural($created_by, $creation_time) {
    global $link;
    $query = 'SELECT id, winner, created_by
              FROM game
              WHERE created_by=:created_by
              AND creation_time=:creation_time';
    $statement = $link->prepare($query);
    $statement->bindValue(':created_by', $created_by);
    $statement->bindValue(':creation_time', $creation_time);
    $statement->execute();
    $game = $statement->fetch();
    $statement->closeCursor();
    return $game;
  }
  function getGames() {
    global $link;
    $query = 'SELECT id, winner, created_by
              FROM game';
    $statement = $link->prepare($query);
    $statement->execute();
    $teams = $statement->fetchAll();
    $statement->closeCursor();
    return $teams;
  }
  function deleteGame ($id) {
    global $link;
    $query = 'DELETE FROM game
              WHERE id=:id';
    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
  }
  function addGamesTeams($game_id, $team_id, $score) {
    global $link;
    $query = 'INSERT INTO games_teams (game_id, team_id, score)
              VALUES (:game_id, :team_id, :score)';
    $statement = $link->prepare($query);
    $statement->bindValue(':game_id', $game_id);
    $statement->bindValue(':team_id', $team_id);
    $statement->bindValue(':score', $score);
    $statement->execute();
    $statement->closeCursor();
  }
  function updateGamesTeams($game_id, $team_id, $score) {
    global $link;
    $query = 'UPDATE games_teams
              SET score=:score
              WHERE game_id=:game_id
              AND team_id=:team_id';
    $statement = $link->prepare($query);
    $statement->bindValue(':score', $score);
    $statement->bindValue(':game_id', $game_id);
    $statement->bindValue(':team_id', $team_id);
    $statement->execute();
    $statement->closeCursor();
  }
?>
