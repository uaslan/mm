<?php
session_start();

$host="localhost";
$kullaniciadi="database_indhan";
$sifre="an5!]jT;zj5[";
$veritabani="database_indhan";

error_reporting(0);

//PDO bağlantısı
try {
    $db = new PDO('mysql:host=' . $host . ';dbname=' . $veritabani, $kullaniciadi, $sifre);
} catch (PDOException $e) {
    print "Hata!: " . $e->getMessage() . "<br/>";
    die();
}

$db->query("SET NAMES utf8");
$db->query("SET CHARACTER SET utf8");
$db->query("SET COLLATION_CONNECTION='utf8_general_ci'");

//------------------PDO SON-------------------------------

/*VERİTABANI SEÇME
$baglan=mysql_connect($host,$kullaniciadi,$sifre);
if (!$baglan){echo "Sunucu ile bağlantı kurulamıyor.";}
$tablo_baglan = mysql_select_db($veritabani,$baglan);
if (!$tablo_baglan){echo "Veritabanı ile bağlantı kurulamıyor.";}

// TÜRKÇE KARAKTER PROBLEMİNİ ORTADAN KALDIRMAK İÇİN AŞAĞIDAKİ KODLAMA YAPILIR.
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION='utf8_general_ci'");
*/
$ayarlar=$db->query('select * from ayarlar where id = 1 limit 0,1')->fetch(PDO::FETCH_ASSOC);
//$ayarlar = mysql_fetch_array(mysql_query('select * from ayarlar where id = 1 limit 0,1'));

function permayap($buyut) {

$buyut = trim($buyut);

$once=array("ş","Ş","ı","(",")","'","ü","Ü","ö","Ö","ç","Ç"," ","/","*","?","ş","Ş","ı","ğ","Ğ","İ","ö","Ö","Ç","ç","ü","Ü","q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m");

$sonra=array("Ş","Ş","I","","","","Ü","Ü","Ö","Ö","Ç","Ç"," ","-","-","","Ş","Ş","I","Ğ","Ğ","İ","Ö","Ö","Ç","Ç","Ü","Ü","Q","W","E","R","T","Y","U","İ","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M");

$buyut=str_replace($once,$sonra,$buyut);


return $buyut;

}


function trisim($deger) {

$deger = trim($deger);

$turkce=array("ş","Ş","ı","(",")","'","ü","Ü","ö","Ö","ç","Ç"," ","/","*","?","ş","Ş","ı","ğ","Ğ","İ","ö","Ö","Ç","ç","ü","Ü","Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M");

$duzgun=array("s","s","i","","","","u","u","o","o","c","c","-","-","-","","s","s","i","g","g","i","o","o","c","c","u","u","q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m");

$deger=str_replace($turkce,$duzgun,$deger);

$deger = preg_replace("@[^A-Za-z0-9-_]+@i","",$deger);

return $deger;

}

$model	 		= $_REQUEST['model'];

$gelenid 		= $_REQUEST['id'];
$replytocom 	= $_REQUEST['replytocom'];
$gelenid 		= preg_replace('/[^0-9]/s', '', $gelenid);
$urltespit 		= $_SERVER['REQUEST_URI'];
$kat1id			= $gelenid;
$tum 			= $_REQUEST['tum'];
$tum 			= preg_replace('/[^0-9]/s', '', $tum);


$siteid			= 1;
$grup			= 1;
$urunid			= 1;

$urun=$db->query("SELECT * FROM urunler WHERE id=".$urunid)->fetch(PDO::FETCH_OBJ);

$unvan			= "Ünvan";

$site = $db->query('select * from siteler where id = '.$siteid)->fetch(PDO::FETCH_ASSOC);
$ulke=$db->query("SELECT * FROM ulkeler WHERE id=".$site['ulke'])->fetch(PDO::FETCH_OBJ);
//$site   		= mysql_fetch_array(mysql_query('select * from siteler where id = '.$siteid.''));

$kaynak			= $site['kaynak'];

$sitename 		= $site['siteadresi'];

$amung	 		= $site['amung'];
$pixel	 		= $site['pixel'];

$analytics	 	= $site['analytics'];

$adres	 		= $site['adres'];

$telefon	 	= $site['telefon'];

$yeni 			= $_REQUEST['yeni'];
				date_default_timezone_set('Europe/Istanbul');
$today			= date("Y-m-d");
$todaytime		= date("Y-m-d H:i:s");

function GetIP(){
    if(getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    } else {
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}

if($_POST['section']=="tellme"){
	unset($_POST['section']);
	$sql="INSERT INTO beniara SET ";
	foreach($_POST as $key=>$value){
		$sql.=$key."='".$value."',";
	}
	$sql=rtrim($sql,",");
	if($db->query($sql)){
		echo "<script>alert('Müşteri Temsilcimiz Siparişiniz İçin En Kısa Sürede Sizinle İrtibata Geçecektir.');</script>";
	}
}

?>
