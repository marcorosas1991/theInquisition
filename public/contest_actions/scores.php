<?php include '../view/header.php'; ?>

<section>
  <h1>Results</h1>

  <?php foreach ($teams_in_game as $t_id => $team): ?>
    <?php $class = $t_id == $winner ? "winner" : ""?>
    <p class="results <?php echo $class; ?>">
      <?php echo $team['name'].": ".$team['score']; ?>
    </p>
  <?php endforeach; ?>

  <form class="center alignRight" action="." method="post">
    <input type='submit' class='button contestButton' name='action' value='Done'/>
  </form>

</section>

<?php include '../view/footer.php'; ?>
