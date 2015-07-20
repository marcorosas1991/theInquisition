<?php
  require_once '../model/session.php';

  startSession();
  validateSession();
?>

<?php include '../view/header.php'; ?>

<section>
  <div class='scoreBar'>
    <?php
    $score_str = "";
    foreach ($teams_in_game as $team) {
      $score_str .= $team['name'].": <span class='score'>".$team['score']."</span> ";
    }
    ?>
    <p>
      <?php echo $score_str; ?>
    </p>
  </div>

  <div>
    <form action="." method="post">
      <input type="submit" class="button floatRight" name="action" value="Finish Game"/>
    </form>
  </div>
</section>
<section>
  <h1>Pick A Topic</h1>

  <?php include '../view/error.php'; ?>

  <div class="center">
    <?php
    $i = 0;
    foreach ($topics as $topic) {
      $topic_name = $topic['name'];
      $topic_id = $topic['id'];

      $color = $i % 2 == 0 ? 2: 1;

      if ($i % 3 == 0) {
        echo "<div>";
      }

      echo "
      <div class='contest_topic'>
        <form action='.' method='post'>
          <input type='hidden' value='$topic_id' name='topic_id'/>
          <input type='hidden' value='show_question' name='action'/>
          <input type='submit' class='bigButton btnColor$color' name='submit' value='$topic_name'/>
        </form>
      </div>
      ";

      if ($i % 3 == 2) {
        echo "<div>";
      }

      $i++;
    }
    ?>
  </div>
</section>

<?php include '../view/footer.php'; ?>
