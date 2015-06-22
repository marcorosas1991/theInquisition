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


?>
