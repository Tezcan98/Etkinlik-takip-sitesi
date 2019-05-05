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
<script src="js/jquery.js"></script>
</head>

<body>


     <div id="modal-wrapper" class="modal">

    <form class="modal-content animate" action="etkinlikler.php?list=1" method="post">

      <h2> Hobilerinizi Güncellemek için kutuları isaretleyip Onay'ı tıklayın (Tum kutular bos kalamaz)</h2>
      <label class="kutular">
        <input name="int[0]" type="checkbox" id="Futbol"  value="Futbol">
        Futbol</label>
      <label class="kutular">
        <input name="int[1]" type="checkbox" id="Basketbol" value="Basketbol">
        Basketbol</label>
      <label class="kutular">
        <input name="int[2]" type="checkbox" id="Sinema"   value="Sinema">
        Sinema/Tiyatro</label>
      <label class="kutular"><br>
        <input name="int[3]" type="checkbox" id="Konser"  value="Konser">
        Konser</label>
      <label class="kutular">
        <input name="int[4]" type="checkbox" id="Yaris" value="Yaris">
        Yarış</label>
      <label class="kutular"> <br>


    	    <button  class="update" name="update" type="submit" >Onay </a></button>

      <div class="container">

      </div>

    </form>

  </div>

<?php

if (!isset($_SESSION["ID"])) {

  header("Location:index.php");
}
if(!isset($_GET["list"]))
     header("location:etkinlikler.php?list=1");

     ?>


<div class="header">
	</div>
<header class="clearfix">
    <div class="container">
            <div class="header-left">
              <h2> <?php echo $_SESSION["uname"] . "<br> ilgilendikleriniz : " .$_SESSION["interest"]; ?></h2>
            </div>
            <div class="header-right">
                <label for="open">
                    <span class="hidden-desktop"></span>
                </label>
                <input type="checkbox" name="" id="open">
                <nav>

                  <?php  $is=""; $oklar="";  if(isset($_GET['id'])) {$yaz="Tekrar Filtrele";$is=""; $oklar="id=tumetkinlikler&";}else{$yaz="Tüm Etkinlikler"; $is="id=tumetkinlikler"; $oklar=""; }?>
                  <a href="etkinlikler.php?list=1&<?php echo $is;?>">
                    <?php echo $yaz; ?>
                  </a>

                  <?php
                  if($_SESSION["uname"] != "Misafir") echo'

                    <a href="bilgiler.php">Hesap Bilgilerim</a>
                    <a  class="lnk"  onclick=gett() > Hobilerim  </a>
                    <a href="exit.php">Çıkış Yap</a>  ' ;
                    else {
                      echo "
                      <a href='giris.php'> Giris Yap </a>
                   ";  }



                     ?>
                        </nav>
            </div>
        </div>
    </header>


 </div>

<?php



 ?>

 <div class='main'>
   <div class="pop"> <table class="table">



  <?php   $conn=connect();
     $sql="SELECT event_id, COUNT(event_id) AS frq
     FROM followed_events
     GROUP BY event_id
     ORDER BY frq DESC limit 5
     ";
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {

       $vals=array();

       while($row = $result->fetch_assoc()) {
           array_push($vals,$row["event_id"]);

       }
     }
    $conn->close();

    $contents=array();
    $link=array();
    for($i=0;$i<6;$i++){
        array_push($contents,"0");
        array_push($link,"#");
      }
       $len=sizeof($vals);
    $conn=connect();
    for($i=0;$i<$len;$i++){
    $sql="Select * from events where id= $vals[$i]";
    $result=$conn->query($sql);

    if($result->num_rows >0){

      while($row=$result->fetch_assoc()){
          $contents[$i]=$row["content"];
          $link[$i]=$row["link"];
      }
    }
  }
    $conn->close();
     ?>
     <table class="takip">
  <h1 >En Çok Takip Edilen 5 Etkinlik</h1>
     <tbody >


       <?php
       for($i=0;$i<$len;$i++){
       echo "
       <tr  >
         <td> <h3>".
         $contents[$i]
         ." </h3>   <a href='". $link[$i] ."'> Siteye Git </a>
          </td>
        </tr>";
      }
        ?>
     </tbody>
   </table>
   </div>
   <h1> Begenebileceginiz Etkinlikler </h1>


<?php $conn=connect();
$sql = "SELECT id,category,content,date_t,link FROM events";
$result = $conn->query($sql);
$adet=0;
$id=array();
$cat=array();
$cont=array();
$date=array();
$lnk=array();
$dilimler= array();
$dilimler = explode("/", $_SESSION["interest"]);
if ($result->num_rows > 0) {
    // output data of each row
    for($i=0;$i<5;$i++)
        array_push($dilimler,"a");
    while($row = $result->fetch_assoc()) {
      //  echo "id: " . $row["id"]. " - İcerik: " . $row["category"]. " " . $row["content"]. "<br>" .$row["date_t"];



   if($row["category"]==$dilimler[1] || $row["category"]==$dilimler[2] ||$row["category"]==$dilimler[3] ||$row["category"]==$dilimler[4] ||$row["category"]==$dilimler[5] || isset($_GET['id']))
    {
      array_push($id,$row["id"]);
      array_push($cat,$row["category"]);
      array_push($cont,$row["content"]);
      array_push($date,$row["date_t"]);
      array_push($lnk,$row["link"]);
      $adet++;
    }


    }
} else {
    echo "0 results";
}


$conn->close();


$yazi="Takip Et";
$class="like";
$list=$_GET["list"];
$sayac=0;
for($i=0;$i<$adet;$i++){

 if(control_buttons($id[$i])){
     $yazi="Takiptesin";
     $class="liked";
   } //MİSAFIRSE EKRANA POP-UP GELSİN...
   else {$yazi="Takip Et";
   $class="like";
   }

if($sayac<($list*3) && $sayac>=(($list-1)*3)){
echo "
<table class='shadow'>

      <tr>
      <td>";
        switch ($cat[$i]) {
          case 'Sinema':
            $kaynak="sinema";
            break;
            case 'Basketbol':
           $kaynak="basket";
            break;
           case 'Futbol':
           $kaynak="futbol";
           break;
           case 'Yaris':
           $kaynak="yaris";
           break;
           case 'Konser':;
           $kaynak="konser";
            break;
        }
        echo "<img class='img' src='css/images/".$kaynak. ".jpg'> </img>";
        if($_SESSION["uname"] != "Misafir"){
          echo "<form action='etkinlikler.php' method='post'>
            <button type='submit' class=$class name=$class value=$id[$i] > $yazi </button>

        </form> ";
      }
   echo "    <p class='etkinlik'>    Etkinlik Numarasi : ". $id[$i] . ":   "."Kategori : " .
             $cat[$i]."<br> <h2>".
             $cont[$i]."</h2> Tarih = ".
             $date[$i]." </p>
             <br>
             <a href='". $lnk[$i] ."'> <h2 id='gosite'> Siteye Git </h2> </a>
</td>.
      </tr>

   </table>
";
}

$sayac++;
}
$don=($adet/3)+(($adet%3)&1);

if($list>1)
echo "<a  href='etkinlikler.php?". $oklar . "list=" . ($list-1) ."'>";
  echo "<img class='yon' src='css/images/sol.png'> </img> </a>";
if($list<$don)
  echo "</a>";
  for($i=0;$i<$don;$i++)
    echo   "<a  id='oklar' href='etkinlikler.php?". $oklar . "list=" . ($i+1)."'>". ($i+1). "&nbsp;&nbsp;" ;
    if($list<$don)
    echo "<a  href='etkinlikler.php?". $oklar . "list=" . ($list+1) ."'>";
      echo "<img class='yon' src='css/images/sag.png'> </img> </a>";
    if($list<$don)
      echo "</a>";
?>






 </div>


<script>

var modal = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function gett(){
document.getElementById('modal-wrapper').style.display='block'
}

$(document).ready(function(){

<?php

    echo  "$('#" . $dilimler[1]."').attr( 'checked' ,true);";
    echo  "$('#" . $dilimler[2]."').attr( 'checked' ,true);";
    echo  "$('#" . $dilimler[3]."').attr( 'checked' ,true);";
    echo  "$('#" . $dilimler[4]."').attr( 'checked' ,true);";
    echo  "$('#" . $dilimler[5]."').attr( 'checked' ,true);";
    echo  "$('#" . $dilimler[6]."').attr( 'checked' ,true);";




?>

});


</script>


</body>
</html>
