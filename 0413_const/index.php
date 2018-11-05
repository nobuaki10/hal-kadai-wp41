<!doctype html>
<html lang="ja">
  <head>
    <title></title>
  </head>
  <body>
    <?php
      echo PHP_VERSION;
      echo "<br>";
      echo PHP_OS;
      echo "<br>";
      echo __LINE__;
      echo "<br>";
      echo __FILE__;
      echo "<br>";
      echo __DIR__;
      echo "<br>";

      //定数定義
      define("MAX_COUNT",20);
      echo MAX_COUNT;
    ?>
  </body>
</html>
