<?php

  /*
  topic model

  Marco A. rosas

  */

  function addTopic($name) {
    global $link;
    $query = 'INSERT INTO topic (name)
              VALUES (:name)';

    $statement = $link->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
  }

  function updateTopic($id, $name) {
    global $link;
    $query = 'UPDATE topic
              SET name=:name
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
  }

  function getTopic($id) {
    global $link;
    $query = 'SELECT id, name
              FROM topic
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $topic = $statement->fetch();
    $statement->closeCursor();
    return $topic;
  }

  function getTopics() {
    global $link;
    $query = 'SELECT id, name
              FROM topic
              ORDER BY name';

    $statement = $link->prepare($query);
    $statement->execute();
    $topics = $statement->fetchAll();
    $statement->closeCursor();
    return $topics;
  }

  function deleteTopic ($id) {
    global $link;
    $query = 'DELETE FROM topic
              WHERE id=:id';

    $statement = $link->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
  }

?>
