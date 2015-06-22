<?php include '../view/header.php'; ?>

<section>
  <form action="." method="post">
    <h1>Pick Topic</h1>

    <?php include '../view/error.php'; ?>
    
    <?php
    foreach ($topics as $topic) {
      $topic_name = $topic['name'];
      $topic_id = $topic['id'];

      echo "
      <form action='.' method='post'>
        <input type='hidden' value='$topic_id' name='topic_id'/>
        <input type='hidden' value='show_question' name='action'/>
        <input type='submit' class='bigButton btnColor1' name='submit' value='$topic_name'/>
      </form>
      ";
    }
    ?>
  </form>
</section>

<?php include '../view/footer.php'; ?>
