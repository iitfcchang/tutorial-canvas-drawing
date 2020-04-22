<?php
function gen_imglist() {
    include('/usr/local/etc/drawingsdb_config.php');
    $dbh = new PDO($dbdsn, $dbuser, $dbpass);
    $sql = "select id from drawings order by ctime desc limit 10;";
    ob_start();
    foreach($dbh->query($sql) as $row) {
        $imgid = $row['id'];
        echo "<div class=\"drawing_box\"><img class="drawing_img" src=\"show_drawing?id=$imgid\"></div>";
    }
    ob_end();
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
