<?php
  require_once '../model/session.php';

  startSession();
  validateSession();
?>

<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>

<section>
  <h1>Update Team: <span class="no_text_transform"><?php echo $team_name; ?></span></h1>

  <?php include '../view/error.php'; ?>

  <form action="." method="post">
    <input type="hidden" name="team_id" value="<?php echo $team_id; ?>"/>
    <label>Name:</label>
    <input type="text" name="team_name" value="<?php echo $team_name; ?>" />
    <label>&nbsp;</label>
    <input type="submit" class="button" name="action" value="Update Team Name"/>
  </form>
  <hr>
  <p>
    <?php
      $num_part = count($participants);
      $part_str = $num_part == 1? "participant" : "participants";
      echo $num_part." ".$part_str;
    ?>
  </p>

  <!-- if number of integrants is less than 3, the addition button, appears -->
  <?php
    if ($num_part < 3) :
  ?>
  <form action="." method="post">
    <input type="hidden" name="action" value="add_participant"/>
    <input type="hidden" name="team_id" value="<?php echo $team_id; ?>"/>
    <input type="submit" class="roundButton" value="+"/>
  </form>
  <?php endif; ?>

  <?php
    if ($num_part > 0) {
      echo "<table class='center'>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Major</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>";
          foreach ($participants as $participant) {
            $id = $participant['id'];
            $name = $participant['name'];
            $email = $participant['email'];
            $major = $participant['major'];

            echo "
            <tr>
              <td>
                <p>$name</p>
              </td>
              <td>
                <p>$email</p>
              </td>
              <td>
                <p>$major</p>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='p_id' value='$id'/>
                  <input type='hidden' name='action' value='Edit Participant' />
                  <input type='submit' class='textButton' name='submit' value='Edit'/>
                </form>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='p_id' value='$id'/>
                  <input type='hidden' name='action' value='Delete Participant'/>
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
