<?php
session_start();
//conntect funct ile donmessek "Undefined variable: conn " hatasi veriyor.
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
function initialize_tables()
{
  $conn=connect();

 $sql="CREATE DATABASE IF NOT EXİST id8520085_sistem";
$conn->query($sql);
	$sql = "CREATE TABLE IF NOT EXISTS users (
	id VARCHAR(16) PRIMARY KEY,
	fname VARCHAR(30) NOT NULL,
	lname VARCHAR(30) NOT NULL,
  username VARCHAR(50),
  UNIQUE (username),
  password VARCHAR(50),
	mail VARCHAR(50),
  UNIQUE (mail),
	interest VARCHAR(100),
	reg_date TIMESTAMP
	)";
$conn->query($sql);
 	/*if ($conn->query($sql) === TRUE) {
		echo "Table users created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	} */

	$sql = "CREATE TABLE IF NOT EXISTS events (
	id VARCHAR(32) PRIMARY KEY,
	category VARCHAR(30) NOT NULL,
	content TEXT(2000) NOT NULL,
	date_t TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	//	echo "Table events created successfully";
	} else {
		//echo "Error creating table: " . $conn->error;
	}

	$sql = "CREATE TABLE IF NOT EXISTS followed_events (
	user_id VARCHAR(16)  NOT NULL,
	event_id VARCHAR(16)  NOT NULL,
  date_t TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
// 	echo "Table events created successfully";
	} else {
//	 echo "Error creating table: " . $conn->error;
	}




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

function add_new_user($name, $surname,$username, $mail,$password,$interest)
{
	//generate the id by increasing the existing max id by one
$conn= connect();
$date = date("Y-m-d H:i:s");
$token =  uniqid();
$sql = "INSERT INTO users (id,fname,lname,username,password,mail,interest,reg_date)
  VALUES ('$token' ,'$name','$surname','$username','$password','$mail','$interest','$date')";//date('Y-m-d H:i:s')

	if ($conn->query($sql) === TRUE)
	{
  	return 1;
	}
	else
	{
		return 0;
	}
}

//this is like onclick listener. select which button is clicked

 if ($_POST ){
    initialize_tables();
    if(isset($_POST["enter"])){
   if(!gir($_POST["uname"],$_POST["psw"]))
         echo " <p class=soru2 > Kullanici adi ya da şifreniz hatali</p>" ;
  }
  else {
     if(isset($_POST["guest"]))
       if(isset($_POST['int'])){
        $_SESSION["uname"]="Misafir";
        $_SESSION["ID"]=0;
        // seçilmiş kutuları $int degiskenine atıp onu bir sonraki sayfaya gonderiyorum..:
        $int="";
        foreach($_POST['int'] as $selected){
            $int=$int."/".$selected;
        }
        $_SESSION["interest"]=$int;
        header('location:etkinlikler.php');

      }
      else {
        echo "En azindan birini secin.";
      }
  }
  if(isset($_POST["kyt"])){
      if(isset($_POST["int"])){ //
          if (!empty($_POST['ad']) && !empty($_POST['soyad']) && !empty($_POST['unam']) && !empty($_POST['email']) && !empty($_POST['pas1']) && !empty($_POST['pas2'])){
             if($_POST['pas1'] == $_POST['pas2']){
             $name=$_POST["ad"];
             $surname=$_POST["soyad"];
             $username=$_POST["unam"];
             $email=$_POST["email"];
             $password=$_POST["pas1"];
             $int="";
             foreach($_POST['int'] as $selected){
                 $int=$int."/".$selected;
              }
              echo $int;
     //    add_new_user("admin123","null","admin", "tezcan","123","basket");
              if(add_new_user($name,$surname,$username,$email,$password,$int))
                  gir($username,$password);
            }else {
               echo "Sifreler Ayni Olmali";
            }
          }
          else {
           echo "Eksik Alan var.";
          }
        }
        else {
          echo "En azindan birini secin.";
        }
    }

}


?>
