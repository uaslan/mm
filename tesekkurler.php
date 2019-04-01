<?php
include 'ayar.php';

if($_GET['PID']=="telgonder"){
		$tel = $_GET['telefon'];
    $tel = str_replace("(", "", $tel);
    $tel = str_replace(")", "", $tel);
    $tel = str_replace("-", "", $tel);
    $tel = ltrim($tel, "0");
		$tel = $_POST['alanKod'].$tel;

	$eskiSiparis=$db->query("SELECT id FROM siparis WHERE sessionid='".htmlspecialchars(session_id())."'");
	if($eskiSiparis->rowCount()<1){

	$EksikSql="INSERT INTO siparis SET gun='".date("Y-m-d")."',sessionid='".htmlspecialchars(session_id())."',durum=2,urunid=".$urunid.",siteid=".$siteid.",telefon='".htmlspecialchars($tel)."'";
	if(!empty($_GET['adsoyad'])){
		$EksikSql.=",isim='".$_GET['adsoyad']."'";
	}
	if(!empty($_GET['adres'])){
		$EksikSql.=",adres='".$_GET['adres']."'";
	}
	if(!empty($_GET['sehir'])){
		$EksikSql.=",ilid='".$_GET['sehir']."'";
	}
	if(!empty($_GET['ilce'])){
		$EksikSql.=",ilceid='".$_GET['ilce']."'";
	}
	$EksikSql.=",ip='".GetIP()."'";
}else{
	$EksikSql="UPDATE siparis SET gun='".date("Y-m-d")."',sessionid='".htmlspecialchars(session_id())."',durum=2,urunid=".$urunid.",siteid=".$siteid.",telefon='".htmlspecialchars($tel)."'";
	if(!empty($_GET['adsoyad'])){
		$EksikSql.=",isim='".$_GET['adsoyad']."'";
	}
	if(!empty($_GET['adres'])){
		$EksikSql.=",adres='".$_GET['adres']."'";
	}
	if(!empty($_GET['sehir'])){
		$EksikSql.=",ilid='".$_GET['sehir']."'";
	}
	if(!empty($_GET['ilce'])){
		$EksikSql.=",ilceid='".$_GET['ilce']."'";
	}
	$eskiSiparisID=$eskiSiparis->fetch(PDO::FETCH_OBJ);
	$EksikSql.=",ip='".GetIP()."' WHERE id=".$eskiSiparisID->id;
}
	$db->query($EksikSql);
}

if ($_POST) {
	
		$urun_id = $urunid;
    $urundetay = $db->query("SELECT * FROM urunler WHERE id=" . $urun_id)->fetch(PDO::FETCH_ASSOC);
    $sitedetay = $db->query("SELECT * FROM siteler WHERE id=" . $siteid)->fetch(PDO::FETCH_ASSOC);

    $adet = $_POST['adet'];
	if(isset($_POST['renk'])){
		if(isset($_POST['numara'])){
			$numara=$_POST['numara']."-".$_POST['renk'];
		}else{
			$numara=$_POST['renk'];
		}
	}else{
		$numara=$_POST['numara'];
	}
	
    switch ($adet) {
        case "1":
            $tutar = 59;
            break;

        case "2":
            $tutar = 99;
            break;
    }


    $isim = permayap(htmlspecialchars($_POST['adsoyad']));
//TELEFON TEMİZLEME
    $telefon = $_POST['telefon'];
    $telefon = str_replace("(", "", $telefon);
    $telefon = str_replace(")", "", $telefon);
    $telefon = str_replace("-", "", $telefon);
    $telefon = ltrim($telefon, "0");
		$telefonNew = $_POST['alanKod'].$telefon;
//------------------------------------------------
    //$platform = $_POST['platform'];
    $ilid = $_POST['sehir'];
    $ilceid = $_POST['ilce'];
    $ulkekod = $_POST['ulkekod'];
    $odemetipi = $_POST['odeme'];
    $adres = permayap(htmlspecialchars($_POST['adres']));
    $note = htmlspecialchars($_POST['note']);
    $ip = GetIP();
    $gun = date("Y-m-d");
    $takipno = rand(11111111111, 99999999999);
    $takipno = str_replace("-", "", $takipno);
    date_default_timezone_set('Europe/Istanbul');
    $tarih = date("Y-m-d H:i:s");
    $gun = date("Y-m-d");
    $today = date("Y-m-d");
    $ipadet = $db->query("SELECT ip FROM siparis WHERE gun='" . $gun . "' AND ip='" . $ip . "'");
    $sonkayit = $db->query('SELECT id FROM siparis where isim="' . $isim . '" and urunid="' . $urun_id . '" and  telefon="' . $telefon . '" and adet="' . $adet . '" and tutar="' . $tutar . '" and odemetipi="' . $odemetipi . '" and adres="' . $adres . '" and numara="' . $numara . '" and siteid="' . $siteid . '" and note="' . $note . '" and ilid="' . $ilid . '" and ilceid="' . $ilceid . '" and gun="' . $today . '" and ip="' . $ip . '" ');

    if ($ipadet->rowCount() <= 100 && $sonkayit->rowCount() < 100 && !empty($_POST['adsoyad']) && !empty($_POST['telefon'])) {
        $ekleSql = "INSERT INTO siparis SET
       		urunid=" . $urun_id . ",
            numara='" . $numara . "',
            isim='" . $isim . "',
            telefon='" . $telefonNew . "',
            ulkekod='" . $ulkekod . "',
            adet='" . $adet . "',
            tutar='" . $tutar . "',
            odemetipi='" . $odemetipi . "',
            adres='" . $adres . "',
            note='" . $note . "',
            durum=1,
            ip='" . $ip . "',
            siteid=" . $siteid . ",
            gun='" . $gun . "',
            takipno=" . $takipno . ",
            tarih='" . $tarih . "',
            ilid='" . $ilid . "',
            ilceid='" . $ilceid . "'";

        $sipSorgu=$db->query("SELECT id FROM siparis WHERE gun='".$gun."' AND telefon='".$telefon."' AND sessionid='".session_id()."'")->fetch(PDO::FETCH_ASSOC);

        if(isset($sipSorgu['id'])){
					$ekleSql=str_replace("INSERT INTO","UPDATE",$ekleSql);
					$ekleSql.=" WHERE id=".$sipSorgu['id'];
				}
				//echo $ekleSql;die;
        $db->query($ekleSql);
    }
    ?>
<?php } ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8">
        <title><?= $_SERVER['HTTP_HOST'] ?></title>
        <?=$amung ?>
        <?=$pixel ?>

        <style>
            @media only screen and (max-device-width: 1024px) {
                img{width:100%;}
            }
        </style>

    </head>
    <body style="background:#333; margin:0; padding:0;">
    <div class="GenelDisDiv">
        <div class="GenelAlan" style="width:100%;text-align: center">
            <img src="tesekkur.jpg" alt="">
        </div>
    </div>
    </body>
    </html>
