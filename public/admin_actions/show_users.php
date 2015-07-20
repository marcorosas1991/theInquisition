<?php
  require_once '../model/session.php';

  startSession();
  validateSession();
?>

<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>
<section>

  <h1>Users</h1>

  <?php include '../view/error.php'; ?>
  <form action="." method="post">
    <label>Username:</label>
    <br>
    <input type="text" name="username" value="" required />
    <br>
    <label>Password:</label>
    <br>
    <input type="password" name="password" value="" required />
    <br>
    <label>&nbsp;</label>
    <input type="submit" class="button" name="action" value="Add User"/>
  </form>
  <hr>

  <?php

    $numUsers = count($users);
    if($numUsers == 0) {
      echo '<p>0 Users</p>';
    } else {
      $ending = $numUsers == 1 ? "":"s";
      echo "<p>$numUsers User".$ending."</p>";

      echo "
      <table class='center'>
        <thead>
          <tr>
            <th>Username</th>
            <th>Usertype</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>";
          foreach ($users as $user) {
            echo "
            <tr>
              <td>
                <p>".$user["username"]."</p>
              </td>
              <td>
                <p>".$user["userType"]."</p>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='user_id' value='".$user["id"]."'/>
                  <input type='hidden' name='action' value='Edit User' />
                  <input type='submit' class='textButton' name='submit' value='Edit'/>
                </form>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='user_id' value='".$user["id"]."'/>
                  <input type='hidden' name='action' value='Delete User'/>
                  <input type='submit' class='textButton' name='submit' value='Delete'/>
                </form>
              </td>
            </tr>";
          }
        echo "
        </tbody>
      </table>";
    }
  ?>
</section>

<?php include '../view/footer.php'; ?>
