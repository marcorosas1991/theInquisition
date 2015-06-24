<?php include '../view/header.php'; ?>

<section>
  <p>
    <?php echo $q_text; ?>
  </p>

  <?php
  if (isset($q_answer)) {
    echo "<p class='answerText'>answer: ".$q_answer."</p>";
  }
  ?>

  <form class="alignRight" action="." method="post">
    <input type="hidden" name="q_id" value="<?php echo $q_id; ?>"/>
    <input type='submit' class='button' name='action' value='<?php echo $action; ?>'/>
  </form>
</section>

<?php include '../view/footer.php'; ?>
