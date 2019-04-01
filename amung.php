<?php include ('ayar.php'); $sayfam=1;
	$urunidsi			= $urunid;
	$renk				= $_POST['renk'];
	

$urundetay = mysql_fetch_array(mysql_query('select * from urunler where id = '.$urunidsi.'')); 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?=$sitename?></title>
</head>
<body>

<?=$amung?>

</body>
</html>