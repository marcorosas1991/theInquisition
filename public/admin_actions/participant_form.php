<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>

<section>
  <h1><?php echo $action_str; ?> Participant</h1>

  <?php include '../view/error.php'; ?>

  <div>
    <form action="." method="post">
      <input type="hidden" name="p_id" <?php echo isset($p_id) ? "value='".$p_id."'": ""?>/>
      <label>Choose a team:</label>
      <br>
      <select name="p_topic">
        <?php
          $t_selection = isset($p_team) ? $p_team:-1;

          foreach ($teams as $team) {
            $teamId = $team['id'];
            $teamName = $team['name'];
            echo "
            <option value='$teamId'".($t_selection == $teamId ? 'selected':'').">$teamName</option>";
          }
        ?>
      </select>
      <br>
      <label>Name:</label>
      <br>
      <input type="text" class="wide" value="<?php echo isset($p_name) ? $p_name: ""; ?>"/>
      <br>
      <label>Email:</label>
      <br>
      <input type="text" class="wide" value="<?php echo isset($p_email) ? $p_email: ""; ?>"/>
      <br>
      <label>Major:</label>
      <br>
      <input type="text" class="wide" value="<?php echo isset($p_major) ? $p_major: ""; ?>"/>
      <br>
      <label>&nbsp;</label>
      <input type="submit" class="button" name="action" value="<?php echo $action_str; ?> Participant"/>
    </form>
  </div>
</section>

<?php include '../view/footer.php'; ?>
