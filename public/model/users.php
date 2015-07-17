<?php



function userType($user_id) {
  global $link;
  $query = 'SELECT userType
            FROM user
            WHERE id=:id';
  $statement = $link->prepare($query);
  $statement->bindValue(':id', $user_id);
  $statement->execute();
  $user_type = $statement->fetch();
  $statement->closeCursor();
  return $user_type;
}

function getUser($username, $password) {
  global $link;
  $query = 'SELECT id, username, userType
            FROM user
            WHERE username=:username
            AND CAST(AES_DECRYPT(password, :username) AS CHAR(128)) = :password';
  $statement = $link->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':password', $password);
  $statement->execute();
  $user = $statement->fetch();
  $statement->closeCursor();
  return $user;
}

function addUser($username, $password, $userType) {
  global $link;
  $query = 'INSERT INTO user (username, password, userType)
            VALUES (:username, AES_ENCRYPT(:password, :username), :userType)';
  $statement = $link->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':password', $password);
  $statement->bindValue(':userType', $userType);
  $statement->execute();
  $statement->closeCursor();
}

function getUsers() {
  global $link;
  $query = 'SELECT id, username, userType
            FROM user
            WHERE userType <> 0';
  $statement = $link->prepare($query);
  $statement->execute();
  $users = $statement->fetchAll();
  $statement->closeCursor();
  return $users;
}

function deleteUser($id) {
  global $link;
  $query = 'DELETE FROM user
            WHERE id=:id';
  $statement = $link->prepare($query);
  $statement->bindValue(':id', $id);
  $statement->execute();
  $statement->closeCursor();
}


?>
