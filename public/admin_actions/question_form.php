<?php include '../view/header.php'; ?>

<section>
  <center>
    <h1>Add Question</h1>

    <div>
      <form action="." method="post">
        <input type="hidden" name="question_id" value=""/>
        <label>Choose Topic:</label>
        <select name="q_topic">
          <?php
            foreach ($topics as $topic) {
              $topicId = $topic['id'];
              $topicName = $topic['name'];
              echo "
              <option value='$topicId'>$topicName</option>";
            }
          ?>
        </select>
        <br>
        <label>Select Difficulty:</label>
        <select name="q_difficulty">
          <option value='0'>Standard</option>
          <option value='0'>Advanced</option>
        </select>
        <br>
        <label>Question:</label>
        <br>
        <textarea type="text" name="question" value="" /></textarea>
        <br>
        <label>Answer:</label>
        <br>
        <textarea type="text" name="answer" value="" /></textarea>
        <br>
        <label>&nbsp;</label>
        <input type="submit" class="button" name="action" value="Add Question"/>
      </form>
    </div>

  </center>
</section>

<?php include '../view/footer.php'; ?>
