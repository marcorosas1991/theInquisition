<?php include '../view/header.php'; ?>

<section>
    <h1>Pick A Topic</h1>

    <?php include '../view/error.php'; ?>

    <div>
      <?php
      $i = 0;
      foreach ($topics as $topic) {
        $topic_name = $topic['name'];
        $topic_id = $topic['id'];

        $i = $i % 2 == 0 ? 2: 1;

        echo "
        <div class='contest_topic'>
          <form action='.' method='post'>
            <input type='hidden' value='$topic_id' name='topic_id'/>
            <input type='hidden' value='show_question' name='action'/>
            <input type='submit' class='bigButton btnColor$i' name='submit' value='$topic_name'/>
          </form>
        </div>
        ";
        $i++;
      }
      ?>
    </div>
</section>

<?php include '../view/footer.php'; ?>
