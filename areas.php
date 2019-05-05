<?php
 include "etkinlik.php";
 ?>
 <!DOCKTPYE html>
<html>
<head>


<link href="css/etkinlik.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/button.css"  type="text/css">
<script src="js/jquery.js"></script>
</head>
<body>

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
         echo "<img src='css/images/".$kaynak. ".jpg'> </img>";
         if($_SESSION["uname"] != "Misafir"){
           echo "<form action='etkinlikler.php' method='post'>
             <button type='submit' class=$class name=$class value=$id[$i] > $yazi </button>

         </form> ";
       }
    echo "    <p class='etkinlik'>    Etkinlik Numarasi : ". $id[$i] . ":   "."Kategori : " .
              $cat[$i]."<br> <h2>".
              $cont[$i]."</h2> Tarih = ".
              $date[$i]." </p>
 
       </tr>

    </table>
";
}

?>

<script>
$(function(){



    //  var genislik=$("div").css("width");
    //  genislik= parseInt($(".cubuk").css("width"),10);


  });


});
</script>


</body>
</html>
