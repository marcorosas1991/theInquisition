<?php include '../view/header.php'; ?>


<section>
  <?php if ($userType == 0) : ?>
  <div class="alignRight">
    <form action="." method="post">
      <input type="submit" class="button btnColor1" name="action" value="Start A Game"/>
    </form>
  </div>
  <?php endif; ?>

  <h1>Administrator</h1>
  <?php if ($userType == 0) : ?>
  <form action="." method="post">
    <input type="submit" class="bigButton adminBtnColor1" name="action" value="Questions"/>
    <input type="submit" class="bigButton adminBtnColor2" name="action" value="Topics"/>
  </form>
  <?php endif; ?>
  <form action="." method="post">
    <input type="submit" class="bigButton adminBtnColor1" name="action" value="Teams"/>
    <!-- <input type="submit" class="bigButton adminBtnColor2" name="action" value="Games"/> -->
  </form>
  <form action="." method="post">
    <input type="submit" class="bigButton adminBtnColor1" name="action" value="Users"/>
  </form>
</section>

<?php include '../view/footer.php'; ?>
