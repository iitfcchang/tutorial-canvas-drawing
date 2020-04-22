<?php
function gen_imglist() {
    include('/usr/local/etc/drawingsdb_config.php');
    $dbh = new PDO($dbdsn, $dbuser, $dbpass);
    $sql = "select id,ctime from drawings order by ctime desc limit 10;";
    ob_start();
    foreach($dbh->query($sql) as $row) {
	$imgid = $row['id'];
        $ts = $row['ctime'];
	echo "<div class=\"drawing_box\">";
	echo "<div>$ts</div>";
	echo "<img class=\"drawing_img\" src=\"show_drawing.php?id=$imgid\">";
	echo "</div>";
    }
    ob_end_flush();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Latest 10 Drawings</title>
        <style>
        .drawing_box { border: 2px solid black; }
        .drawing_img { border-style: outset; }
        </style>
    </head>
    <body>
        <h1>Latest 10 Drawings</h1>
        <?php gen_imglist();?>
    </body>
</html>
