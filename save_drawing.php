<?php
if (isset($_POST['imgdata'])) {
  $imgdata = $_POST['imgdata'];
} else {
  die('Not valid use of this URL');
}
$fname = tempnam('/var/www/html/imgs', 'draw');
$bname = basename($fname);
$f = fopen($fname, 'w');
fwrite($f, file_get_contents($imgdata));
fclose($f);

// creating the 128x128 thumbnail
$im = ImageCreateFromJPEG($fname);
$imw = ImageSX($im);
$imh = ImageSY($im);
$s = ($imw>$imh)?$imw:$imh;
$thw = $imw*128/$s;
$thh = $imh*128/$s;
$th = ImageScale($im, $thw, $thh);
$tname = "/var/www/html/imgs/th-$bname";
ImageJPEG($th, $tname);

include('/usr/local/etc/drawingsdb_config.php');
$dbh = new PDO($dbdsn, $dbuser, $dbpass);
$sql = "insert into drawings(name) values ('$bname');";
$dbh->exec($sql);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Received Drawing</title>
  </head>
  <body>
    <img src="imgs/<?=$bname?>">
  </body>
</html>
