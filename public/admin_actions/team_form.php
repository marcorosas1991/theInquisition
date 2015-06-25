<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>

<section>
  <h1>Update Team</h1>

  <?php include '../view/error.php'; ?>

  <form action="." method="post">
    <input type="hidden" name="team_id" value="<?php echo $team_id; ?>"/>
    <label>Name:</label>
    <input type="text" name="team_name" value="<?php echo $team_name; ?>" />
    <label>&nbsp;</label>
    <input type="submit" class="button" name="action" value="Update Team"/>
  </form>
  <hr>
</section>

<?php include '../view/footer.php'; ?>
