<?php
$username = $_POST['username'];
$useremail = $_POST['useremail'];
$usersubject= $_POST['usersubject'];
$usermessage = $_POST['usermessage'];
if(!empty($username)|| !empty($useremail)|| !empty($usersubject)||!empty($usermessage)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbname="my_db";
    //create connection
    $conn= new mysqli($host, $dbUsername, $dbPassword,$dbname);
    if(mysqli_connect_error()){
        die('connect Error('.mysqli_connect_error().')'.mysqli_connect_error());

    }else{
        $SELECT="SELECT useremail From contactus Where useremail = ? Limit 1";
        $INSERT= "INSERT Into contactus (username, useremail,usersubject, usermessage) values(?,?,?,?)";
        //prépare statement
        $stmt =$conn->prepare($SELECT);
        $stmt -> bind_param("s",$useremail);
        $stmt->execute();
        $stmt->bind_result($useremail);
        $stmt->store_result();
        $rnum=$stmt->num_rows;
        if ($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt -> bind_param("ssss",$username,$useremail,$usersubject,$usermessage);
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