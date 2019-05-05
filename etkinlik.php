<?php
session_start();

function connect(){
$servername = "localhost";
/*
$username = "id8520085_tezcan";
$password = "654321";
$db="id8520085_sistem";
*/
$username = "root";
$password = "";
$db="etkinlik";

$conn = new mysqli($servername, $username, $password,$db);   //object

// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

return $conn;
}

function gir($kullanici,$sifre){
  $conn=connect();
  $giris = "SELECT * FROM users where username='$kullanici' and password='$sifre'";
  $getir = $conn->query($giris);

  if($getir->num_rows>0){

    while($row = $getir->fetch_assoc()){
  	   $_SESSION["uname"]=$row["username"];
       $_SESSION["ID"]=$row["id"];
       $_SESSION["interest"]=$row["interest"];
     }

       header("location:etkinlikler.php?list=1");

     }
     else {
       return 0;
     }
}

function screen_account($id,$data){
  $conn=connect();
  $screen="SELECT * FROM users where id='$id'";
    $getir = $conn->query($screen);

    if($getir->num_rows>0){

      while($row = $getir->fetch_assoc()){
         return $row[$data];
       }



       }


}

function add_followed_event($user_id, $event_id)
{
  $conn=connect();
  $sql = "select date_t from events where id = $event_id";
  $result =  $conn->query($sql) ;
  if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      $date_t=$row["date_t"];
  }
  }
  {
  $sql = "INSERT INTO followed_events (user_id,event_id,date_t)
              VALUES ('$user_id' ,'$event_id', '$date_t')";

  if ($conn->query($sql) === TRUE)
  {
    echo "New followed event record created successfully";
  }
  else
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

function update_interest($interest,$user_id){
  $conn=connect();
  $sql="UPDATE users SET interest='$interest' WHERE id='$user_id'";
 $conn->query($sql);
  $conn->close();
}

function update_account($fname,$lname,$mail,$pass ,$user_id){
  $conn=connect();
  $sql="UPDATE users SET fname='$fname',lname='$lname',mail='$mail',password='$pass' WHERE id='$user_id'";
 $conn->query($sql);
  $conn->close();
}


function delete_followed_event($user_id, $event_id){

    $conn=connect();
    $sql="DELETE FROM followed_events WHERE event_id='$event_id' AND user_id='$user_id' ";

     $conn->query($sql);

    $conn->close();

}

function control_buttons($event_id){
  $conn=connect();
  $id=$_SESSION["ID"];
  $sql = "SELECT * FROM followed_events WHERE user_id='$id' AND event_id=$event_id";
  $result =  $conn->query($sql) ;
  if ($result->num_rows > 0) {
        return 1;
  }

  return 0;
}



 if ($_POST ){
   if(isset($_POST["like"])){
         add_followed_event($_SESSION["ID"], $_POST["like"]);
         header("location:etkinlikler.php?list=1");
       }
       else
   if(isset($_POST["liked"])){
     $ses=$_SESSION["ID"];
     delete_followed_event($ses,$_POST["liked"]);
   }
   else
      if(isset($_POST["update"])){
        $inter="";

        if(!empty($_POST['int'])){
        foreach($_POST['int'] as $selected){
            $inter=$inter."/".$selected;
        }
        update_interest($inter,$_SESSION["ID"]);
         $_SESSION["interest"] =$inter;
       }
       else {
         echo "Bir ilgi alanınız olmalı.";
       }
      }
    else if(isset($_POST["kytgncl"])){

      $msg="";
      if(!empty($_POST['pas'])){
        if (!empty($_POST['ad']) && !empty($_POST['soyad'])  && !empty($_POST['email'])){
          $name=   $_POST["ad"];
          $surname=$_POST["soyad"];
          $email=$_POST["email"];
            if(!empty($_POST['newpass']) && !empty($_POST['newpass2'])) {
                  if($_POST['newpass'] == $_POST['newpass2']){

                        $password=$_POST["newpass"];
                        update_account($name,$surname,$email,$password,$_SESSION["ID"]); //$fname,$lname,$mail,$pass ,$user_id
                        }
                    else {
                      $msg= "Sifreler Uyuşmuyor. Lütfen tekrar kontrol ediniz.";
                    }
            }
            else {
              update_account($name,$surname,$email,screen_account($_SESSION["ID"],"password"),$_SESSION["ID"]);
              $msg="Hesap Bilgileriniz Basari ile guncellendi. !";
            }
        }
        else {
          $msg="Sifre Alani Haric Bos Alan Kalmamali.";
        }
      }
      else {
                $msg="Guncelleme icin lutfen sifrenizi giriniz";
      }

      echo"
      <div id='error' class='modal' style=' display : block;' >

       <form class='modal-content animate' action='bilgiler.php' method='post'>

       &nbsp;
       <h2> ". $msg." </h2>

       <input class='error' type='submit' value='Tamam'>

       </form>

       </div>
      ";

    }

 }


?>
