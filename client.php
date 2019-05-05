<?php
ob_start(); include "log.php" ?>
<!DOCKTPYE html>
<html>
<head>
<meta charset="utf-8">
<title>Haydi Sosyalleselim !</title>

<link href="css/client.css" rel="stylesheet" type="text/css">
<link href="css/button.css" rel="stylesheet" type="text/css">
<link href="css/popup.css" rel="stylesheet" type="text/css">

</head>

<body class="back">


<a onclick="document.getElementById('modal-wrapper').style.display='block'" class="lnk"> Giris Yap </a> <p class="bfrlnk"> Zaten bir hesabınız var mı ? </p>

<div id="modal-wrapper" class="modal">
  <form class="modal-content animate" action="client.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
      <img src="css/images/1.png" alt="Avatar" class="avatar">
      <h1 style="text-align:center">Kullanıcı Bilgilerinizi Giriniz.</h1>
    </div>

    <div class="container">
      <input type="text" placeholder="Kullanıc Adı" name="uname" id="text" value="<?php
   if(isset($_COOKIE['username'])) echo $_COOKIE['username'];?>">
      <input type="password" placeholder="Sifre" name="psw" id="password"  value="<?php
   if(isset($_COOKIE['password'])) echo $_COOKIE['password'];
  ?>">
      <button type="submit"  name="enter"> Giriş Yap</button>
	 <input type="checkbox" name="hatirla" > Beni Hatırla
    </div>
  </form>
</div>

<nav class="header" onclick="document.location.href='index.php'"></nav>
<div class="secenek">
  <p class="soru"> Bize Kendinden Bahsetmek Ister misin ? </p>
  <p class="soru2"></p>
		<form method="post" action="client.php">
    <label for="textfield" class="labels">&nbsp;Ad&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
		</label>
		<input name="ad" id="ad" type="text" class="txtbok">
		<br><br>
		<label for="textfield" class="labels">&nbsp;Soyad&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		</label>
		<input name="soyad" type="text" class="txtbok" >
  </p><p class="soru2"><br>
    <label for="textfield6" class="labels">&nbsp;E-Mail&nbsp;   &nbsp; &nbsp; &nbsp;</label>
    <input name="email" type="email" class="txtbok">
    <br><br>
	<label for="textfield6" class="labels">Kullanıcı Adı </label>
	<input name="unam" type="text" class="txtbok" id="mail2"><br><br>
	<label for="textfield6" class="labels">Şifre</label> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
	<input name="pas1" type="password" class="txtbok" id="mail2"> <br><br>
	<label for="textfield6" class="labels">Şifre Tekrar </label>&nbsp;
	<input name="pas2" type="password" class="txtbok" id="mail2">

  </p>

  <p class="labels"> &nbsp; Hoşlandığın alanları seç lütfen.</p>



	  <label class="kutular">
	    <input name="int[]" type="checkbox" class="kutular" value="Futbol">
	    Futbol</label>
	  <label class="kutular">
	    <input name="int[]" type="checkbox" class="kutular" value="Basketbol">
	    Basketbol</label>
	  <label class="kutular">
	    <input name="int[]" type="checkbox" class="kutular"  value="Sinema">
	    Sinema/Tiyatro</label>
	  <label class="kutular"><br>
	    <input name="int[]" type="checkbox" class="kutular" value="Konser">
	    Konser</label>
	  <label class="kutular">
	    <input name="int[]" type="checkbox" class="kutular"value="Yaris">
	    Yarış</label>
	  <label class="kutular"> <br>

		    <button  name="kyt" type="submit" >Kayıt Ol ve Listele </a></button>
	  </form>

  <br>
  <br>
</div>



<div class="foot">
	<p> Sistem Programlama Dersi İçin Tasarlanmıştır </p>

</div>
	<script>
// If user clicks anywhere outside of the modal, Modal will close

var modal = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>
