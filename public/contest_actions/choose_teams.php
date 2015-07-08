<?php include '../view/header.php'; ?>

<section>
  <center>
    <form action="." method="post">
      <h1>Start Game</h1>
      <?php if (!isset($teams_in_game) || count($teams_in_game) < 4)  :?>
      <label>Add Teams:</label>
      <br>
      <select name="team_id">
         <?php
          foreach ($teams as $team) {
            $teamId = $team['id'];
            $teamName = $team['name'];
             echo "<option value='$teamId'>$teamName</option>";
           }
         ?>
       </select>
       <input type="submit" class="roundButton" name="action" value="+"/>
     <?php endif; ?>
   </form>

   <hr>

   <!-- if teams have been selected -->
   <?php if(isset($teams_in_game) && count($teams_in_game) > 0) : ?>

     <h3>In the Game:</h3>
     <table class='center'>
       <thead>
         <tr>
           <th></th>
           <th></th>
         </tr>
       </thead>
       <tbody>
        <?php
        foreach ($teams_in_game as $t_id => $team_in_game) {
          $t_name = $team_in_game['name'];
          echo "
          <tr>
            <td>
              $t_name
            </td>
            <td>
              <form action='.' method='post'>
                <input type='hidden' name='team_id' value='$t_id'/>
                <input type='submit' class='textButton' name='action' value='Remove Team'/>
              </form>
            </td>
          </tr>
          ";
        }
        ?>
       </tbody>
     </table>
   <?php endif; ?>

   <?php if(isset($teams_in_game) && count($teams_in_game) > 1) : ?>
     <form action="." method="post">
       <br>
        <label>&nbsp;</label>
        <br>
        <input type="submit" class="button" name="action" value="Start"/>
      </form>
   <?php endif; ?>

  </center>
</section>

<?php include '../view/footer.php'; ?>
