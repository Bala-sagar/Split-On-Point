<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    include('connect.php');

    $query = "UPDATE users set name='" . $name ."' where " . "regno='" . "20BCE1936';";
    mysqli_query($conn,$query);
    // echo $query;

    $query = "UPDATE users set email='" . $email ."' where " . "regno='" . "20BCE1936';";
    mysqli_query($conn,$query);

    $query = "UPDATE users set phone='" . $phone ."' where " . "regno='" . "20BCE1936';";
    mysqli_query($conn,$query);

    echo "<script> alert('Saved changes successfully');</script>";
    header("Location: http://localhost/IWP-JCOMP/Script/profile.php");