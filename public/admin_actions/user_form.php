<?php
  require_once '../model/session.php';

  startSession();
  validateSession();
?>

<?php include '../view/header.php'; ?>

<?php include '../view/back_button.php'; ?>

<section>
  <h1>Update User</h1>

  <?php include '../view/error.php'; ?>
  <form action="." method="post">
    <label>Username:</label>
    <br>
    <input type="text" name="username" value="<?php echo $username;?>" required/>
    <br>
    <label>Password:</label>
    <br>
    <input type="password" name="password" value="" required/>
    <br>
    <label>&nbsp;</label>
    <input type="submit" class="button" name="action" value="Update User"/>
  </form>
  <hr>

</section>

<?php include '../view/footer.php'; ?>
