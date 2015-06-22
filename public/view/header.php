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
  <a class="title" href=".">The Inquisition</a>
  <?php
  if (isset($start_in_menu)) : ?>
    <form action="." method="post">
      <input type="submit" class="button floatRight" name="action" value="Start Contest"/>
    </form>
  <?php endif; ?>
</header>
