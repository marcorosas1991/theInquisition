<?php include '../view/header.php'; ?>

<section>
  <center>
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
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>";
            foreach ($topics as $topic) {
              echo "
              <tr>
                <td>
                  ".$topic["name"]."
                </td>
                <td>
                  <form action='.' method='post'>
                    <input type='hidden' name='topic_id' value='".$topic["id"]."'/>
                    <input type='hidden' name='action' value='Edit Question'/>
                    <input type='submit' class='textButton' name='action' value='Edit'/>
                  </form>
                </td>
                <td>
                  <form action='.' method='post'>
                    <input type='hidden' name='topic_id' value='".$topic["id"]."'/>
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
  </center>
</section>

<?php include '../view/footer.php'; ?>
