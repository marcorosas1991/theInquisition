<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>

<section>

  <h1>Questions</h1>

  <?php include '../view/error.php'; ?>

  <form action="." method="post">
    <label>&nbsp;</label>
    <input type="submit" class="roundButton" name="action" value="+"/>
  </form>
  <hr>

  <?php

    $numQuestions = count($questions);

    if($numQuestions == 0) {
      echo '<p>0 Questions</p>';
    } else {
      $ending = $numQuestions == 1 ? "":"s";
      echo "<p>$numQuestions Question".$ending."</p>";

      echo "
      <table class='center'>
        <thead>
          <tr>
            <th class='questionRow'>Question</th>
            <th class='answerRow'>Answer</th>
            <th>Difficulty</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>";
          foreach ($questions as $question) {
            echo "
            <tr>
              <td>
                <p>".$question["question"]."</p>
              </td>
              <td class='centerText'>
                <p>".$question["answer"]."</p>
              </td>
              <td>
                <p>".($question["difficulty"] == 1 ? "Standard":"Advanced")."</p>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='q_id' value='".$question["id"]."'/>
                  <input type='hidden' name='action' value='Edit Question'/>
                  <input type='submit' class='textButton' name='submit' value='Edit'/>
                </form>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='q_id' value='".$question["id"]."'/>
                  <input type='hidden' name='action' value='Delete Question'/>
                  <input type='submit' class='textButton' name='submit' value='Delete'/>
                </form>
              </td>
            </tr>";
          }
        echo "
        </tbody>
      </table>";
    }
  ?>
</section>

<?php include '../view/footer.php'; ?>
