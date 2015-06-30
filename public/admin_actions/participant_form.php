<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>

<section>
  <h1><?php echo $action_str; ?> Participant</h1>

  <?php include '../view/error.php'; ?>

  <div>
    <form action="." method="post">
      <input type="hidden" name="p_id" <?php echo isset($p_id) ? "value='".$p_id."'": ""?>/>
      <label>Choose Topic:</label>
      <select name="p_topic">
        <?php
          $t_selection = isset($p_topic) ? $p_topic:-1;
          $d_selection = isset($p_difficulty) ? $p_difficulty:-1;

          foreach ($topics as $topic) {
            $topicId = $topic['id'];
            $topicName = $topic['name'];
            echo "
            <option value='$topicId'".($t_selection == $topicId ? 'selected':'').">$topicName</option>";
          }
        ?>
      </select>
      <br>
      <label>Select Difficulty:</label>
      <select name="p_difficulty">
        <option value='1' <?php echo $d_selection == 1 ? 'selected':'' ?>>Standard</option>
        <option value='2' <?php echo $d_selection == 2 ? 'selected':'' ?>>Advanced</option>
      </select>
      <br>
      <label>Participant:</label>
      <br>
      <textarea type="text" name="p_text" value="" /><?php echo isset($p_text) ? $p_text: ""; ?></textarea>
      <br>
      <label>Answer:</label>
      <br>
      <textarea type="text" name="p_answer" value="" /><?php echo isset($p_answer) ? $p_answer: ""; ?></textarea>
      <br>
      <label>&nbsp;</label>
      <input type="submit" class="button" name="action" value="<?php echo $action_str; ?> Participant"/>
    </form>
  </div>
</section>

<?php include '../view/footer.php'; ?>
