<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>

<section>
  <h1>Update Topic</h1>

  <?php include '../view/error.php'; ?>

  <form action="." method="post">
    <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>"/>
    <label>Name:</label>
    <input type="text" name="topic_name" value="<?php echo $topic_name; ?>" />
    <label>&nbsp;</label>
    <input type="submit" class="button" name="action" value="Update Topic"/>
  </form>
  <hr>
</section>

<?php include '../view/footer.php'; ?>
