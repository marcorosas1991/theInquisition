<!DOCTYPE HTML>
<html>
  <head>
    <link rel="stylesheet" href="/css/style.css">
    <title>PHP Variables</title>
  </head>
  <body>

    <?php
      $line1 = '<p>She said, "it\'s Spring."</p>';
      $line2 = '<p>He replied, "So?"</p>';
      $line3 = '<p>She said, "Thoughts are supposed to turn to love."</p>';
      $line4 = '<p>Hesitantly, he responded, "Where is the headed?"</p>';
      $line5 = '<p>She looked at him with a flat stare</p>';

      $text = $line1.$line2.$line3.$line4.$line5;

      echo $text;
    ?>

  </body>
</html>
