<?php include '../view/header.php'; ?>

<section>
  <p>
    <?php echo $q_text; ?>
  </p>
  <form class="alignRight" action="." method="post">
    <input type='submit' class='button' name='action' value='Show Answer'/>
  </form>
</section>

<?php include '../view/footer.php'; ?>
