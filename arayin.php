<?php
include 'ayar.php';

if ($_POST) {
	$sql="INSERT INTO `beniara` SET ad='".$_POST['ad']."',tel='".$_POST['tel']."',siteid='8',siteadi='".$_SERVER['HTTP_HOST']."',ip='".GetIP()."'";
	$db->query($sql);
	echo "1";
}

?>
