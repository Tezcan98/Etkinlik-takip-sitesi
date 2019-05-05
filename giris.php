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


<nav class="header" onclick="document.location.href='index.php'"></nav>
<div class="secenek">
  <p class="soru"> Giris icin kayit bilgilerin gerekli </p>
  <p class="soru2"></p>
		<form method="post" action="giris.php">
    <label for="textfield" class="labels">&nbsp;Kullanıcı Adı
		</label> &nbsp;
		<input name="uname" id="ad" type="text" class="txtbok" value="<?php
 if(isset($_COOKIE['username'])) echo $_COOKIE['username'];?>">
		<br><br>,
		<label for="textfield" class="labels">&nbsp;Sifre&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		</label>
		<input name="psw" type="password" class="txtbok" value="<?php
 if(isset($_COOKIE['password'])) echo $_COOKIE['password'];
?>" >




  <p class="labels"> &nbsp; Şifremi Hatırla.   <input type="checkbox" name="hatirla"></p>




		    <button  name="enter" type="submit" >Giris Yap </a></button>
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
