<?php
 include "etkinlik.php";
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-po8">
<title>Dilediğiniz Her Şey Burada.</title>
<link href="css/etkinlik.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/button.css"  type="text/css">
<link href="css/popup.css" rel="stylesheet" type="text/css">
</head>

<body>


<?php

if (!isset($_SESSION["ID"])) {

  header("Location:index.php");
}

 ?>


<div class="header">
	</div>
<header class="clearfix">
    <div class="container">
            <div class="header-left">
              <h1> <?php echo $_SESSION["uname"] . "<br> ilgilendikleri : " .$_SESSION["interest"]; ?></h1>
            </div>
            <div class="header-right">
                <label for="open">
                    <span class="hidden-desktop"></span>
                </label>
                <input type="checkbox" name="" id="open">
                <nav>
                  <a href="#">Tüm Etkinlikler</a>
                  <?php
                  if($_SESSION["uname"] != "Misafir") echo'
                    <a href="#">İstatistikler</a>
                    <a href="#">Hesap Bilgilerim</a>
                    <a href="#">Hobilerim</a>
                    <a href="exit.php">Çıkış Yap</a>  ';
                    else {
                      echo "
                      <a onclick=&quot;document.getElementById(&apos;modal-wrapper&apos;).style.display=&apos;block&apos;&quot;class=&quot;lnk&quot;> Giris Yap </a>
                   ";  }


                    //else {
                    //  echo "<a onclick='document.getElementById('modal-wrapper').style.display='block'' class='lnk'> Giris Yap </a>";
                  //  }
                     ?>
                        </nav>
            </div>
        </div>
    </header>
<div class="pop"> <table class="table">
  <tbody>
    <tr>
      <th scope="col">En Çok Takip Edilen 5 Etkinlik</th>
    </tr>
    <tr>
      <td>
        &nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>

  </tbody>
</table>

 </div>
 <div class='main'>
	 <table class='table'>
	   <tbody>
	     <tr>
	       <th scope='col'>Begenebilecegin Etkinlikler</th>
	     </tr>
<?php
$conn=connect();
$sql = "SELECT id,category,content,date_t FROM events";
$result = $conn->query($sql);
$adet=0;
$id=array();
$cat=array();
$cont=array();
$date=array();
$dilimler= array();
$dilimler = explode("/", $_SESSION["interest"]);
if ($result->num_rows > 0) {
    // output data of each row
    for($i=0;$i<5;$i++)
        array_push($dilimler,"a");
    while($row = $result->fetch_assoc()) {
      //  echo "id: " . $row["id"]. " - İcerik: " . $row["category"]. " " . $row["content"]. "<br>" .$row["date_t"];
   if($row["category"]==$dilimler[1] || $row["category"]==$dilimler[2] ||$row["category"]==$dilimler[3] ||$row["category"]==$dilimler[4] ||$row["category"]==$dilimler[5] )
    {
      array_push($id,$row["id"]);
      array_push($cat,$row["category"]);
      array_push($cont,$row["content"]);
      array_push($date,$row["date_t"]);
      $adet++;
}
    }
} else {
    echo "0 results";
}


$conn->close();

$yazi="Takip Et";
$class="like";
 for($i=0;$i<$adet;$i++){

  if(control_buttons($id[$i])){
      $yazi="Takiptesin";
      $class="liked";
    } //MİSAFIRSE EKRANA POP-UP GELSİN...
    else {$yazi="Takip Et";
    $class="like";
    }
 echo "
	     <tr>
	       <td> ";
         if($_SESSION["uname"] != "Misafir"){
           echo "<form action='etkinlikler.php' method='post'>
             <button type='submit' class=$class name=$class value=$id[$i] > $yazi </button>

         </form> ";
       }
    echo "    <p class='etkinlik'>    Etkinlik Numarasi : ". $id[$i] . ":   "."Kategori : " .
              $cat[$i]."<br> <h2>".
              $cont[$i]."</h2> Tarih = ".
              $date[$i]." </p>

				 </td>
	     </tr>
";
}
?>

	   </tbody>
	 </table>

 </div>

   <div id="modal-wrapper" class="modal">

     <form class="modal-content animate" action="etkinlikler.php" method="post">

       <div class="imgcontainer">
         <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
         <img src="css/images/1.png" alt="Avatar" class="avatar">
         <h1 style="text-align:center">Kullanıcı Bilgilerinizi Giriniz.</h1>
       </div>

       <div class="container">
         <input type="text" placeholder="Kullanıc Adı" name="uname" id="text">
         <input type="password" placeholder="Sifre" name="psw" id="password">
         <!--<button type="submit"  name="enter" onclick="window.location.href='etkinlikler.php'" > Giriş Yap</button> -->
       <button  name="guest" type="submit"   >Giriş Yap </a></button>
         <input type="checkbox" > Beni Hatırla
         <a href="#">Şifreni mi unuttun ?</a>
       </div>

     </form>

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
