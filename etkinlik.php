<?php
session_start();

function connect(){
$servername = "localhost";

$username = "id8520085_tezcan";
$password = "654321";
$db="id8520085_sistem";
/*
$username = "root";
$password = "";
$db="etkinlik";*/
// Create connection
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

       header("location:etkinlikler.php");

     }
     else {
       return 0;
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
         header("location:etkinlikler.php");
       }
 if(isset($_POST["liked"])){
   $ses=$_SESSION["ID"];
   delete_followed_event($ses,$_POST["liked"]);

 }




 }


?>
