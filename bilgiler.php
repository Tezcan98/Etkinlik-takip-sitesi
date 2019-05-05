<?php
ob_start(); include "etkinlik.php" ?>
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

  <?php

  if (!isset($_SESSION["ID"])) {

    header("Location:index.php");
  }

   ?>

<div id="modal-wrapper" class="modal">

  <form class="modal-content animate" action="client.php" method="post">

    <div class="imgcontainer">
      <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
      <img src="css/images/1.png" alt="Avatar" class="avatar">
      <h1 style="text-align:center">Kullanıcı Bilgilerinizi Giriniz.</h1>
    </div>

    <div class="container">
      <input type="text" placeholder="Kullanıc Adı" name="uname" id="text">
      <input type="password" placeholder="Sifre" name="psw" id="password">
      <button type="submit"  name="enter"> Giriş Yap</button>
	 <input type="checkbox" > Beni Hatırla
      <a href="#">Şifreni mi unuttun ?</a>
    </div>

  </form>

</div>
<button onclick="location.href='etkinlikler.php?list=1'" id="back"> İceriğe Geri Dön
</button>

<nav class="header" ></nav>
<div class="secenek">
  <p class="soru"> Bilgileriniz Şu Şekilde</p>
  <p class="soru2"></p>
		<form method="post" action="bilgiler.php">
    <label for="textfield" class="labels">&nbsp;Ad&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
		</label>
		<input name="ad" id="ad" type="text" class="txtbok" value="<?php  echo screen_account($_SESSION["ID"],"fname"); ?>">
		<br><br>
		<label for="textfield" class="labels">&nbsp;Soyad&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		</label>
		<input name="soyad" type="text" class="txtbok" value="<?php  echo screen_account($_SESSION["ID"],"lname"); ?>" >
  </p><p class="soru2"><br>
    <label for="textfield6" class="labels"  >&nbsp;E-Mail&nbsp;   &nbsp; &nbsp; &nbsp;</label>
    <input name="email" type="email" class="txtbok" value="<?php  echo screen_account($_SESSION["ID"],"mail"); ?>">
    <br><br>
	 	<label for="textfield6" class="labels">Şifre*</label> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
	<input name="pas" type="password" class="txtbok"  >  <br><br>
  <label for="textfield6" class="labels">Yeni Şifre**</label>  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
  <input name="newpass" type="password" class="txtbok" > <br><br>
&nbsp;&nbsp;&nbsp;&nbsp;	<label for="textfield6" class="labels">Yeni Şifre Tekrar </label>
	<input name="newpass2" type="password" class="txtbok"  > <br><br>

  </p>

 <br><br>
 <br><br> <br>

<h4> *Onaylamak icin sifrenizi giriniz. <br> **Bu alanı sifre degistirmek istiyorsanız doldurun.</h4>
		    <button  name="kytgncl" type="submit" >Bilgilerimi Güncelle </a></button>
	  </form>

  <br>
  <br>
</div>



<div class="foot">
	<p> Sistem Programlama Dersi İçin Tasarlanmıştır </p>

</div>

</body>
</html>
