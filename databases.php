<?php

/**
 * Database conections
 */

function guitar1link() {
   $host = 'localhost';
   $db = 'my_guitar_shop1';
   $usr = 'proxy';
   $pass = 'sesame';
   $dsn = 'mysql:host='.$host.';dbname='.$db;
   $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );

  try {
    $link = new PDO($dsn, $usr, $pass, $options);
    return $link;
    //echo 'worked';
  } catch (PDOException $exc) {
    echo $exc->getTraceAsString();
  }
}

function tech_support_link() {
   $host = 'localhost';
   $db = 'tech_support';
   $usr = 'proxy';
   $pass = 'sesame';
   $dsn = 'mysql:host='.$host.';dbname='.$db;
   $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );

  try {
    $link = new PDO($dsn, $usr, $pass, $options);
    return $link;
    //echo 'worked';
  } catch (PDOException $exc) {
    echo $exc->getTraceAsString();
  }
}

?>
