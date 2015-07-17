<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>

<section>
  <h1><?php echo $action_str; ?> Question</h1>

  <?php include '../view/error.php'; ?>

  <div>
    <form action="." method="post">
      <input type="hidden" name="q_id" <?php echo isset($q_id) ? "value='".$q_id."'": ""?>/>
      <label>Choose Topic:</label>
      <select name="q_topic">
        <?php
          $t_selection = isset($q_topic) ? $q_topic:-1;
          $d_selection = isset($q_difficulty) ? $q_difficulty:-1;

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
      <select name="q_difficulty">
        <option value='1' <?php echo $d_selection == 1 ? 'selected':'' ?>>Standard</option>
        <option value='2' <?php echo $d_selection == 2 ? 'selected':'' ?>>Advanced</option>
      </select>
      <br>
      <label>Question:</label>
      <br>
      <textarea type="text" name="q_text" value="" required ><?php echo isset($q_text) ? $q_text: ""; ?></textarea>
      <br>
      <label>Answer:</label>
      <br>
      <textarea type="text" name="q_answer" value="" required ><?php echo isset($q_answer) ? $q_answer: ""; ?></textarea>
      <br>
      <label>&nbsp;</label>
      <input type="submit" class="button" name="action" value="<?php echo $action_str; ?> Question"/>
    </form>
  </div>
</section>

<?php include '../view/footer.php'; ?>
