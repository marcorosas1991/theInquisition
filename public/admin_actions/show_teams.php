<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>
<section>

  <h1>Teams</h1>

  <?php include '../view/error.php'; ?>
  <form action="." method="post">
    <label>Name:</label>
    <input type="text" name="team_name" />
    <label>&nbsp;</label>
    <input type="submit" class="button" name="action" value="Add Team"/>
  </form>
  <hr>

  <?php

    $numTeams = count($teams);
    if($numTeams == 0) {
      echo '<p>0 Teams</p>';
    } else {
      $ending = $numTeams == 1 ? "":"s";
      echo "<p>$numTeams Team".$ending."</p>";

      echo "
      <table class='center'>
        <thead>
          <tr>
            <th>Name</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>";
          foreach ($teams as $team) {
            echo "
            <tr>
              <td>
                <p>".$team["name"]."</p>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='team_id' value='".$team["id"]."'/>
                  <input type='hidden' name='action' value='Edit Team' />
                  <input type='submit' class='textButton' name='submit' value='Edit'/>
                </form>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='team_id' value='".$team["id"]."'/>
                  <input type='hidden' name='action' value='Delete Team'/>
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
