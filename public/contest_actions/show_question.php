<?php include '../view/header.php'; ?>

<section>
  <p class='questionText'>
    <?php echo $q_text; ?>
  </p>

  <p class='answerText'>
    <?php
    if (isset($q_answer)) {
      echo $q_answer;
    }
    ?>
  </p>


  <form class="center alignRight" action="." method="post">
    <?php if (isset($teams_in_game)) : ?>

      <h2>Points for:</h2>
      <?php foreach ($teams_in_game as $t_id => $team): ?>
        <label class="contestLabel"><?php echo $team['name']; ?></label>
        <input type="checkbox" name="points_to[]" value="<?php echo $t_id;?>">
        <br>
      <?php endforeach; ?>
    <?php endif; ?>

    <input type="hidden" name="q_id" value="<?php echo $q_id; ?>"/>
    <input type='submit' class='button contestButton' name='action' value='<?php echo $action; ?>'/>
  </form>
</section>

<?php include '../view/footer.php'; ?>
