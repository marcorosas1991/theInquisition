<?php

echo '<h2>range</h2>';
$rangeArray = range(4, 10, 4);
foreach ($rangeArray as $key => $value) {
  echo $key.' '.$value.'<br>';
}

echo '<h2>fill</h2>';
$fillArray = array_fill(4, 4, 2);
foreach ($fillArray as $key => $value) {
  echo $key.' '.$value.'<br>';
}

echo '<h2>PAD</h2>';
$newArray = array_pad($fillArray, 6, 80);
foreach ($newArray as $key => $value) {
  echo $key.' '.$value.'<br>';
}

 ?>
