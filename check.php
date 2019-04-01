<?php
include 'ayar.php';
if ($_POST) {

	$siteUlke=explode(",",$site['ulke']);
	$ulkeWHere="(";
	foreach ($siteUlke as $key => $value) {
		$ulkeWHere.="id=$value OR ";
	}
	$ulkeWHere=rtrim($ulkeWHere," OR ");
	$ulkeWHere.=")";
	$ulkeCh=$db->query("SELECT * FROM ulkeler WHERE ".$ulkeWHere." AND ulkeTelKod='".$_POST['ulkekod']."' AND phoneCode LIKE '%".$_POST['alanKod']."%'");
	if($ulkeCh->rowCount()>0){
		$phoneNumber=$_POST['ulkekod'].$_POST['alanKod'].$_POST['telefon'];
		if(strlen($phoneNumber)>12){
			echo $phoneNumber."-Telefon Numarası Fazla Karakter İçeriyor.\nLütfen Ülke ve Alan Kodu ile 12 Hane Olacak Şekilde Giriniz!!";
		}else if(strlen($phoneNumber)<12){
			echo $phoneNumber."-Telefon Numarası Eksik Karakter İçeriyor.\nLütfen Ülke ve Alan Kodu ile 12 Hane Olacak Şekilde Giriniz!!";
		}else{
			$sql="SELECT * FROM metinler WHERE metin ";
			$isim=explode(" ",$_POST['adsoyad']);
			foreach ($isim as $key => $value) {
				$isimArray.="'".$value."',";
			}
			$adres=str_replace("\r","",$_POST['adres']);
			$adres=str_replace("\n","",$adres);
			$adres=explode(" ",$adres);
			foreach ($adres as $key => $value) {
				$isimArray.="'".$value."',";
			}
			$ilce=explode(" ",$_POST['ilce']);
			foreach ($ilce as $key => $value) {
				$isimArray.="'".$value."',";
			}
			$isimArray=rtrim($isimArray,",");
			$sql.="IN($isimArray)";
			$kufur=$db->query($sql);
			if($kufur->rowCount()>0){
				echo "Sayın Müşterimiz Sipariş Formunda İstenmeyen Kelimeler Mevcuttur.\nLütfen Uygunsuz Kelimeleri Kullanmayınız!!!";
			}else{
				$bos=0;
				foreach($_POST as $key=>$value){
					if(empty($_POST[$key])){
						$bos++;
					}
				}
				if($bos==0){
					echo "ok";
				}else{
					echo "Lütfen Eksik Alanları Doldurunuz";
				}
			}
		}
	}else{
		echo $phoneNumber."-Telefon Numarası Hatalıdır\nLütfen Ülke ve Alan Kodu ile 12 Hane Olacak Şekilde Giriniz!!";
	}
}

?>
