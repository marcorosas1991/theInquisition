<?php include 'view/header.php'; ?>

<section>
    <form action="." method="post">
      <h1>Login</h1>
      <label>username:</label>
      <br>
      <input type="text" class="centerText" name="username"/>
      <br>
      <label>password:</label>
      <br>
      <input type="password" class="centerText" name="password"/>
      <br>
      <label>&nbsp;</label>
      <br>
      <input type="submit" class="button" name="submit" value="login"/>
    </form>
</section>

<?php include 'view/footer.php'; ?>
