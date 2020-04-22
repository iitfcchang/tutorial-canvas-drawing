<?php
if (isset($_POST['imgdata'])) {
  $imgdata = $_POST['imgdata'];
} else {
  die('Not valid use of this URL');
}
$fname = tempnam('/var/www/html/imgs', 'draw');
$f = fopen($fname, 'w');
fwrite($f, file_get_contents($imgdata));
fclose($f);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Received Drawing</title>
  </head>
  <body>
    <img src="imgs/<?=basename($fname)?>">
  </body>
</html>
