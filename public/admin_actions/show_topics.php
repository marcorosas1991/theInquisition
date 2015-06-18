<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>
<section>

  <h1>Topics</h1>

  <?php include '../view/error.php'; ?>
  <form action="." method="post">
    <label>Name:</label>
    <input type="text" name="topic_name" />
    <label>&nbsp;</label>
    <input type="submit" class="button" name="action" value="Add Topic"/>
  </form>
  <hr>

  <?php

    $numTopics = count($topics);
    if($numTopics == 0) {
      echo '<p>0 Topics</p>';
    } else {
      $ending = $numTopics == 1 ? "":"s";
      echo "<p>$numTopics Topic".$ending."</p>";

      echo "
      <table class='center'>
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
                <p>".$topic["name"]."</p>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='topic_id' value='".$topic["id"]."'/>
                  <input type='hidden' name='action' value='Edit Topic' />
                  <input type='submit' class='textButton' name='submit' value='Edit'/>
                </form>
              </td>
              <td>
                <form action='.' method='post'>
                  <input type='hidden' name='topic_id' value='".$topic["id"]."'/>
                  <input type='hidden' name='action' value='Delete Topic'/>
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
