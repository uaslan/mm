<?php include('ayar.php')?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    
    <title><?=$sitename?></title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <script type="text/javascript" src="javascript/jquery.js"></script>
  
	<link rel="stylesheet" href="css/mobil-style.css">
	<link rel="stylesheet" href="css/style.css">

	<script src="javascript/jquery.min.js"></script>

  
    <script>
    $(document).bind('mobileinit',function(){
        $.mobile.changePage.defaults.changeHash = false;
        $.mobile.hashListeningEnabled = false;
        $.mobile.pushStateEnabled = false;
    });
    </script>

    <script src="javascript/jquery.mobile-1.4.2.min.js"></script>
    <link href='css/jquery.mobile-1.4.2.css' rel='stylesheet' type='text/css'>
    <link rel="icon" href="lib/img/favicon.png" />
<?=$amung?>
</head>

<body>

<?php 

if($site['whatsapp']==1){ 
	include("Mobile_Detect.php");
	$Tarayici = new Mobile_Detect();

	//if($Tarayici->isMobile() == TRUE or $Tarayici->isTablet() == TRUE){ ?>
		<a href="https://api.whatsapp.com/send?phone=9<?=$telefon?>&text=Merhaba,Sipariş Vermek istiyorum"  target="_blank" style="position: fixed;top: 20px;left: 20px;z-index: 80;height: 50px;padding:10px;">
		<img src="img/whatsapp.png" width="100%" alt="Send Message!" style="height: 100%;width: auto;float: left;margin-right:10px;">
	</a>
<?php } ?>


<link rel="stylesheet" type="text/css" href="css/jquery.lightbox.css" />
<script type="text/javascript" src="javascript/jquery.lightbox.js"></script>
<script type="text/javascript">

jQuery(document).ready(function(){

jQuery('.lightbox').lightbox();

$(document).delegate('a', 'click', function () {
	var gidilecek = $(this).attr("href");
    $("html,body").animate({ scrollTop: $(gidilecek).offset().top }, 200);
	return false;
});


});

</script>

<script>
$(function(){
  $(".content a").each(function(){
    $(this).attr("rel","external");
  });
});
</script>

<div class="content" style="max-width: 1000px; margin: auto">

<div id="clr"></div>

<a href="#siparis"><div class="_cb"><img src="img/01.jpg" class="contentimg"></div></a>
<a href="#siparis"><div class="_cb"><img src="img/02.jpg" class="contentimg"></div></a>
<a href="#siparis"><div class="_cb"><img src="img/03.jpg" class="contentimg"></div></a>
<a href="#siparis"><div class="_cb"><img src="img/04.jpg" class="contentimg"></div></a>
<a href="#siparis"><div class="_cb"><img src="img/05.jpg" class="contentimg"></div></a>
<a href="#siparis"><div class="_cb"><img src="img/06.jpg" class="contentimg"></div></a>
<a href="#siparis"><div class="_cb"><img src="img/07.jpg" class="contentimg"></div></a>
<a href="#siparis"><div class="_cb"><img src="img/08.jpg" class="contentimg"></div></a>
<a href="#siparis"><div class="_cb"><img src="img/09.jpg" class="contentimg"></div></a>
<a href="#siparis"><div class="_cb"><img src="img/siparis.jpg" class="contentimg"></div></a>


<div style="text-align: left; width: 98%;padding:10px;background-color:white;color:black" id="siparis">
<h3>Bitte füllen Sie das untenstehende Formular aus.</h3>
<form class="form-horizontal" method="post" action="tesekkurler.php?islem=1" data-ajax="false" id="payment-form">

<?=$site['adetFormu']?>
<fieldset data-role="controlgroup">
		<legend>Zahlungsart</legend>
        <input type="radio" name="odeme" id="radio-choice-1" value="Kapıda Nakit" checked="checked">
        <label for="radio-choice-1">Nachname</label>

</fieldset>
	
	 <?php if(!empty($urun->numara)){
        $numaralar=explode(",",$urun->numara);
     ?>
	<legend>Numara</legend>
	 <select id="numara" required name="numara">
            <option value="">Numara Seçiniz</option>
            <?php foreach ($numaralar as $key => $value) {?>
              <option value="<?=$value?>"><?=$value?></option>
            <?php } ?>
          </select>
	 <?php } ?>
	 
	 <?php if(!empty($urun->renk)){
        $renkler=explode(",",$urun->renk);
        ?>
	<legend>Renk</legend>
	 <select id="renk" required name="renk">
            <option value="">Renk Seçiniz</option>
            <?php foreach ($renkler as $key => $value) {?>
              <option value="<?=$value?>"><?=$value?></option>
            <?php } ?>
          </select>
	 <?php } ?>
	
    <label for="fname">Vorname*</label>
    <input type="text" name="adsoyad" required id="adsoyad">
	
	<label for="fname">Ulke Kodu</label>
	<input type="text" name="ulkekod" id="ulkekod" value="<?=$ulke->ulkeTelKod?>" readonly>
	
	<label for="fname">Ulke Kodu</label>
	<?php $alanKodları=explode(",",$ulke->phoneCode);?>
    <select id="alanKod" required name="alanKod">
		<option value="">Alan Kodu Seçiniz</option>
        <?php foreach ($alanKodları as $key => $value) {
			echo '<option>'.$value.'</option>';
        } ?>
    </select>
	
    <label for="fname">Telefon</label>
    <input type="tel" name="telefon"  required id="telefon">
	
	<label for="fname">İl</label>
	<?php $iller=$db->query('SELECT * FROM il WHERE ulkeid='.$site["ulke"]);?>
    <select id="il" required name="sehir">
		<option value="">İl Seçiniz</option>
        <?php while($il=$iller->fetch(PDO::FETCH_OBJ)) {
			echo '<option>'.$il->baslik.'</option>';
        } ?>
    </select>	

    <label for="fname">İlçe</label>
    <input type="text" name="ilce" required id="ilce">
	
	<label for="fname">Adres</label>
    <textarea name="adres" required id="adres"></textarea>
	
    <input type="submit" value="Siparişi Gönder" class='submit'>
</form>


</div>

<div class="_cb"><img src="img/alt.jpg" class="contentimg"></div>



<?php if($site['beniara']==1){ ?>
    	<div class="formarea" id="formarea">
    	 <div class="alt_area">
    	 <div class="mygirl"></div>
    	 <form name="tellmefrm" id="arama" method="post" onsubmit="return false">
    		<div class="fl" style="margin-top: 10px">
    		 <input type="text" name="ad" style="margin-top: 5px; z-index:-1;width: 150px;margin-left: 30px;" placeholder="Adınız Soyadınız">
    		</div>
    		<div class="fl" style="margin-top: 10px">
    		 <input type="text" name="tel" style="margin-top: 5px; z-index:-1;width: 150px;margin-left: 30px;" maxlength="11" placeholder="Telefon Numaranız">
    		</div>
    		<div class="fl">
    		 <div>
    				<img src="http://nivadermsakalserumu.com/s/images/send.png" onclick="gonder();" style="cursor: pointer;">
    			</div>
    		</div>
    		<div class="fl">
    		 <div class="formcomment_b commentek">NUMARANIZI BIRAKIN BİZ SİZİ ARAYALIM</div>
    		</div>
    		<div class="fl"></div>
    		<input name="frmIdenty" type="hidden" id="frmIdenty" value="tellme" />
    	 </form>
    	 <div class="clear"></div>
    	 </div>
    	</div>
<?php }?>

</div>
  <script>

    $(".submit").click(function(){
      $.ajax({
        type:'post',
        url:'check.php',
        data:$("#payment-form").serialize(),
        success:function(resp){
          if(resp=="ok"){
            a=1;
            $("#payment-form").submit();
          }else{
            alert(resp);
          }
        }
      })
    });

    var a=0;
    $("#payment-form").submit(function(e){
      if(a==0){
        //console.log(a);
        return false;
      }else if(a==1){
        console.log(a);
      }
    });


    $("[name=telefon]").focusout(function(){
        $.ajax({
          type:'post',
          url:'check.php',
          data:$("#payment-form").serialize(),
          success:function(resp){
            if(resp=="ok"){
              $.ajax({
                type:'GET',
                url:'tesekkurler.php',
                data:"PID=telgonder&"+$('#payment-form').serialize(),
                success:function(cevap){
                  console.log("a");
                }
              })
            }else{
              alert(resp);
            }
          }
        })
    })

    function gonder(){
      $.ajax({
        type:'POST',
        url:'arayin.php',
        data:$('#arama').serialize(),
        success:function(cevap){
          if(cevap!=1){
            $("#sonuc").html(cevap);
          }else{
            alert('Geri Arama Talebiniz iletilmiştir.\nMüşteri temsilcilerimiz size en kısa sürede ulaşacaktır.');
            $('#formarea').hide('slow');
          }
        }
      })
    }
    </script>


<script src="javascript/jquery.chained.js" type="text/javascript" charset="utf-8"></script>
<script src="javascript/jquery.chained.remote.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    $(function() {



        $("[name=adet]").click(function(){
       var adet=$(this).val();
       if(adet==80){
        $(".urun2").fadeOut(500);
        $(".urun3").fadeOut(500);
       }else if(adet==119){
        $(".urun2").fadeIn(500);
        $(".urun3").fadeOut(500);
       }else if(adet==169){
        $(".urun2").fadeIn(500);
        $(".urun3").fadeIn(500);
       }
    });

    /* For jquery.chained.js */
    $("#ilce").chained("#il");
    $("#model").chained("#ilce");
    $("#engine").chained("#ilce, #model");


    $("#numara").chained("#urun");
    $("#model").chained("#numara");
    $("#engine").chained("#numara, #model");	

    /* Show button after each pulldown has a value. */
    $("#engine").bind("change", function(event) {
        if ("" != $("option:selected", this).val() && "" != $("option:selected", $("#model")).val()) {
            $("#button").fadeIn();
        } else {
            $("#button").hide();
        }
    });

    $("#c").chained("#a,#b");

    /* For jquery.chained.remote.js */
    $("#series-remote").remoteChained({
        parents : "#mark-remote",
        url : "json.php?sleep=1",
        loading : "--"
    });
    $("#model-remote").remoteChained({
        parents : "#series-remote",
        url : "json.php?sleep=1",
        loading : "--"
    });
    $("#engine-remote").remoteChained({
        parents : "#series-remote, #model-remote",
        url : "json.php?sleep=1",
        loading : "--",
        clear : true
    });

    /* Show button after each pulldown has a value. */
    $("#engine-remote").bind("change", function(event) {
        if ("" != $("option:selected", this).val() && "" != $("option:selected", $("#model-remote")).val()) {
            $("#button-remote").fadeIn();
        } else {
            $("#button-remote").hide();
        }
    });

    $("#c-remote").remoteChained("#a-remote,#b-remote", "json.php");

    /* For multiple jquery.chained.remote.js */
    $(".series-remote").each(function() {
        $(this).remoteChained($(".mark-remote", $(this).parent()), "json.php");
    });
    $(".model-remote").each(function() {
        $(this).remoteChained($(".series-remote", $(this).parent()), "json.php");
    });
    $(".engine-remote").each(function() {
        $(this).remoteChained([
            $(".series-remote", $(this).parent()),
            $(".model-remote", $(this).parent())
        ], "json.php");
    });

    /* For multiple jquery.chained.js */
    $(".series").each(function() {
        $(this).chained($(".mark", $(this).parent()));
    });
    $(".model").each(function() {
        $(this).chained($(".series", $(this).parent()));
    });
    $(".engine").each(function() {
        $(this).chained([
            $(".series", $(this).parent()),
            $(".model", $(this).parent())
        ]);
    });

    /* For normal input and jquery.chained.remote.js */
    $("#series-remote-2").remoteChained({
        parents : "#mark-remote-2",
        url : "json.php",
    });
    $("#model-remote-2").remoteChained({
        parents : "#series-remote-2",
        url : "json.php"
    });
    $("#engine-remote-2").remoteChained({
        parents : "#series-remote-2, #model-remote-2",
        url : "json.php"
    });

    /* Show button after each pulldown has a value. */
    $("#engine-remote-2").bind("change", function(event) {
        if ("" != $("option:selected", this).val() && "" != $("option:selected", $("#model-remote-2")).val()) {
            $("#button-remote-2").fadeIn();
        } else {
            $("#button-remote-2").hide();
        }
    });
    });

        /*var form = document.getElementById('payment-form'); // form has to have ID: <form id="payment-form">
    form.noValidate = true;
    form.addEventListener('submit', function(event) { // listen for form submitting
    if (!event.target.checkValidity()) {
        event.preventDefault(); // dismiss the default functionality
        alert('Lütfen gerekli alanları doldurunuz'); // error message
    }}, false);*/
</script>

</body>
</html>