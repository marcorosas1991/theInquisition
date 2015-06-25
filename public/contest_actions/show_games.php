<?php include '../view/header.php'; ?>

<section>
  <center>
    <form action="." method="post">
      <h1>Login</h1>
      <label>choose game:</label>
      <br>
      <select name="game" class="center">
        <option value="0">Team vs Teams</option>
      </select>
      <br>
      <label>&nbsp;</label>
      <br>
      <input type="submit" class="button" name="action" value="Start Round"/>
    </form>
  </center>
</section>

<?php include '../view/footer.php'; ?>
