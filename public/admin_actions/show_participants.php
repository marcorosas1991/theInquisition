<?php
  require_once '../model/session.php';

  startSession();
  validateSession();
?>

<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>

<section>

  <h1>Participants</h1>

  <?php include '../view/error.php'; ?>

  <form action="." method="post">
    <label>&nbsp;</label>
    <input type="submit" class="roundButton" name="action" value="+"/>
  </form>
  <hr>

  <?php

    $numParticipants = count($participants);

    if($numParticipants == 0) {
      echo '<p>0 Participants</p>';
    } else {
      $ending = $numParticipants == 1 ? "":"s";
      echo "<p>$numParticipants Participant".$ending."</p>";

      echo "
      <table class='center'>
        <thead>
          <tr>
            <th class='participantRow'>Participant</th>
            <th class='answerRow'>Answer</th>
            <th>Difficulty</th>
            <th>Topic</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>";
          foreach ($participants as $participant) {
            echo "
            <tr>
              <td>
                <p>".$participant["participant"]."</p>
              </td>
              <td class='centerText'>
                <p>".$participant["answer"]."</p>
              </td>
              <td>
                <p>".($participant["difficulty"] == 1 ? "Standard":"Advanced")."</p>
              </td>
              <td>
                <p>".$topics_names[$participant["topic"]]."</p>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='q_id' value='".$participant["id"]."'/>
                  <input type='hidden' name='action' value='Edit Participant'/>
                  <input type='submit' class='textButton' name='submit' value='Edit'/>
                </form>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='q_id' value='".$participant["id"]."'/>
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
