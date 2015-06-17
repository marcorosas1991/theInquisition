<?php include '../view/header.php'; ?>

<section>
  <center>
    <h1>Edit Topic</h1>

    <form action="." method="post">
      <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>"/>
      <label>Name:</label>
      <input type="text" name="topic_name" value="<?php echo $topic_name; ?>" />
      <label>&nbsp;</label>
      <input type="submit" class="button" name="action" value="Update Topic"/>
    </form>
    <hr>
  </center>
</section>

<?php include '../view/footer.php'; ?>
