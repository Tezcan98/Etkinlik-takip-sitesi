<?php
ob_start();
include "log.php"
 ?>
<!DOCTYPE html><html><head>
<meta charset="utf-8">
<title>Haydi Sosyalleselim !</title>

<link href="css/index.css" rel="stylesheet" type="text/css">
<link href="css/button.css" rel="stylesheet" type="text/css">
<link href="css/popup.css" rel="stylesheet" type="text/css">
</head>

<body class="back">



<a href="client.php" class="lnk"> Kayıt Ol </a> <a onclick="document.getElementById('modal-wrapper').style.display='block'" class="lnk"> Giris Yap </a>
<div id="modal-wrapper" class="modal" >

  <form class="modal-content animate" action="index.php" method="post">

    <div class="imgcontainer">
      <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
      <img src="css/images/1.png" alt="Avatar" class="avatar">
      <h1 style="text-align:center">Kullanıcı Bilgilerinizi Giriniz.</h1>
    </div>

    <div class="container">
      <input type="text" placeholder="Kullanıc Adı" name="uname" id="text"  value="<?php
   if(isset($_COOKIE['username'])) echo $_COOKIE['username'];?>">
      <input type="password" placeholder="Sifre" name="psw" id="password" value="<?php
   if(isset($_COOKIE['password'])) echo $_COOKIE['password'];
?>">
      <!--<button type="submit"  name="enter" onclick="window.location.href='etkinlikler.php'" > Giriş Yap</button> -->
    <button  name="enter" type="submit"  >Giriş Yap  </button>
      <input name="hatirla" type="checkbox" > Beni Hatırla
    </div>

  </form>

</div>

<?php
//if($error == true) 
//En azindan birini secin.

?>
<div class="header"></div>
<p class="soru">Bize Kendinden Bahsetmek Ister misin ?<br>
</p>
<div class="secenek">
<p class="soru2">Hoşlandığın alanları seç lütfen. (Her seferinde belirtmek istemiyorsanız <a href="client.php">Buradan</a> Kayıt olabilirsiniz. )</p>


  <form action="index.php" method="post">

  <label class="kutular">
    <input name="int[0]" type="checkbox"   value="Futbol">
    Futbol</label>
  <label class="kutular">
    <input name="int[1]" type="checkbox"  value="Basketbol">
    Basketbol</label>
  <label class="kutular">
    <input name="int[2]" type="checkbox"    value="Sinema">
    Sinema/Tiyatro</label>
  <label class="kutular"><br>
    <input name="int[3]" type="checkbox"   value="Konser">
    Konser</label>
  <label class="kutular">
    <input name="int[4]" type="checkbox"  value="Yaris">
    Yarış</label>
  <label class="kutular"> <br>


	    <button  name="guest" type="submit" >Listele </a></button>

  </form>


  <br>
</div>
<?php initialize_tables(); ?>
	<script>
// If user clicks anywhere outside of the modal, Modal will close

var modal = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<div class="foot">
	<p> Sistem Programlama Dersi İçin Tasarlanmıştır. </p>

</div>


</body></html>
