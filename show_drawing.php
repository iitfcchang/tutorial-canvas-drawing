<?php
if (isset($_GET['id'])) {
    $imgid = $_GET['id'];
    $bname = get_imgname($imgid);
    if ($bname!=null) {
        header('Content-Type: image/jpeg');
        readfile('imgs/'.$bname);
    } else {
        die('No File');
    }
} else {
    die('No Content');
}
function get_imgname($imgid) {
    include('/usr/local/etc/drawingsdb_config.php');
    $dbh = new PDO($dbdsn, $dbuser, $dbpass);
    $sql = "select name from drawings where id='$imgid';";
    $rs = $dbh->query($sql)->fetchAll();
    if (count($rs)==1) {
        return $rs[0]['name'];
    } else {
        return null;
    }
}
?>
