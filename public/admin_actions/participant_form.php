<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>

<section>
  <h1><?php echo $action_str; ?> Participant</h1>

  <?php include '../view/error.php'; ?>

  <?php
    $teamId = $team['id'];
    $teamName = $team['name'];
  ?>

  <div>
    <form action="." method="post">
      <input type="hidden" name="p_id" <?php echo isset($p_id) ? "value='".$p_id."'": ""?>/>
      <label>Team:</label>
      <h2><?php echo $teamName; ?></h2>
      <input type="hidden" name="p_team" value="<?php echo $teamId; ?>"/>
      <br>
      <label>Name:</label>
      <br>
      <input type="text" class="wide" name="p_name" value="<?php echo isset($p_name) ? $p_name: ""; ?>"/>
      <br>
      <label>Email:</label>
      <br>
      <input type="text" class="wide" name="p_email" value="<?php echo isset($p_email) ? $p_email: ""; ?>"/>
      <br>
      <label>Major:</label>
      <br>
      <input type="text" class="wide" name="p_major" value="<?php echo isset($p_major) ? $p_major: ""; ?>"/>
      <br>
      <label>&nbsp;</label>
      <input type="submit" class="button" name="action" value="<?php echo $action_str; ?> Participant"/>
    </form>
  </div>
</section>

<?php include '../view/footer.php'; ?>
