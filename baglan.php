<?php
include "log.php"

 ?>
 <html>
<head>
</head>
<body>



<?php
   echo "Hesaba Giriniz<br><br>";
if ($_POST && !empty($_POST["kadi"])) {
    echo "Yes, mail is set";

} else
    echo "N0, mail is not set";

/*
	if($bilgiler[2] == $_GET["text"])
			echo "Giris Yapildi <br>";

			echo "Kullanici adi yanlis Girilen = ". $_GET["text"] ." istenilen " . $bilgiler[2] ;
	*/

?>

	<form   action="baglan.php" method="post">

		 <input name="uname" type="text"   > <br>
		 <input name="psw" type="password"   > <br>
		 <input name="enter" type="submit" value="Gönder" >
</form>
 

 </body>
 </html>
