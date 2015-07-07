<?php include '../view/header.php'; ?>

<section>
  <h1>Administrator</h1>
  <form action="." method="post">
    <input type="submit" class="bigButton adminBtnColor1" name="action" value="Questions"/>
    <input type="submit" class="bigButton adminBtnColor2" name="action" value="Topics"/>
  </form>
  <form action="." method="post">
    <input type="submit" class="bigButton adminBtnColor1" name="action" value="Teams"/>
    <input type="submit" class="bigButton adminBtnColor2" name="action" value="Games"/>
  </form>
  <form action="." method="post">
    <input type="submit" class="bigButton adminBtnColor1" name="action" value="Users"/>
  </form>
</section>

<?php include '../view/footer.php'; ?>
