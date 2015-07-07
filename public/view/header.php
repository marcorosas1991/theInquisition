<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>The Inquisition Contest</title>
    <link rel="stylesheet" type="text/css" href="/public/style/style.css">
    <meta charset="UTF-8">
</head>

<!-- the body section -->
<body>
<header>
  <h1 class="title">The Inquisition</h1>

  <?php
  if (isset($log_out_in_menu)) : ?>
  <div class="reduceTopMargin">
    <form action="." method="post">
      <input type="submit" class="button floatRight" name="action" value="Log Out"/>
    </form>
  </div>
  <?php endif; ?>
</header>
