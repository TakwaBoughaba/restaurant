<?php
$name = $_POST['name'];
$email = $_POST['email'];
$date3= $_POST['date3'];
$select1 = $_POST['select1'];
$message = $_POST['message'];
if(!empty($name)|| !empty($email)|| !empty($date3)|| !empty($select1)||!empty($message)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbname="my_db";
    //create connection
    $conn= new mysqli($host, $dbUsername, $dbPassword,$dbname);
    if(mysqli_connect_error()){
        die('connect Error('.mysqli_connect_error().')'.mysqli_connect_error());

    }else{
        $SELECT="SELECT email From booking Where email = ? Limit 1";
        $INSERT= "INSERT Into booking (name, email, date3, select1, message) values(?,?,?,?,?)";
        //prépare statement
        $stmt =$conn->prepare($SELECT);
        $stmt -> bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;
        if ($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt -> bind_param("sssis",$name,$email,$date3,$select1,$message);
            $stmt-> execute();
            echo "New record inserted sucessfully";
        }else{
            echo "someone already register using this email";
        }
        $stmt->close();
        $conn->close();
    }
    
}else {
    echo "All field are required";
    die();
    }
?>