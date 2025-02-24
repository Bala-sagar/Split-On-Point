<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fatlab";
    $v1=$_POST["cn"];$v2=$_POST["code"];$v3=$_POST["faculty"];$v4=$_POST["dept"];$v5=$_POST["sn"];$v6=$_POST["reg"];
    $v7=$_POST["year"];$v8=$_POST["deptp"];$v9=$_POST["cc"];$v10=$_POST["fname"];
     
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "INSERT INTO `staff` VALUES ('$v1','$v2','$v3','$v4')";
    $ret1 = mysqli_query($conn, $query);
    $query = "INSERT INTO `student` VALUES ('$v5','$v6','$v7','$v8','$v9','$v10')";
    $ret2 = mysqli_query($conn, $query);
    $query="select name from student where course ='CSE3002'";
    $ret3 = mysqli_query($conn, $query);
    if($ret3->num_rows > 0) {
        while($row = $ret3->fetch_assoc()){
            $row2[] = $row;
        }
        foreach($row2 as $row) {
            echo $row
        }
    }

     

?>