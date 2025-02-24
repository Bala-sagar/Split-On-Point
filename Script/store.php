<?php
session_start();
$name = trim($_POST['name']);
$rgd_no = trim($_POST['regno']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$pass = trim($_POST['pass']);
$conpass = trim($_POST['conpass']);

$_SESSION['regno'] = $rgd_no;
$_SESSION['name'] = $name;

if (empty($name)) {
    echo '<script> alert("Please enter your name") </script>';
    header("Location: ../Pages/SignUp.html");
}

if (empty($rgd_no)) {
    echo '<script> alert("Please enter your registration number") </script>';
    header("Location: ../Pages/SignUp.html");
}

$patt = "/[0-9]{2}[a-zA-z]{3}[0-9]{4}/";
if (!preg_match($patt, $rgd_no)) {
    echo '<script> alert("Please enter valid registartion number") </script>';
    header("Location: ../Pages/SignUp.html");
}

if (empty($email)) {
    echo '<script> alert("Please enter your email id") </script>';
    header("Location: ../Pages/SignUp.html");
}

if (empty($phone)) {
    echo '<script> alert("Please enter your phone number") </script>';
    header("Location: ../Pages/SignUp.html");
}

if (empty($pass)) {
    echo '<script> alert("Please enter your password") </script>';
    header("Location: ../Pages/SignUp.html");
}

if (strlen($pass) < 8) {
    echo '<script> alert("Password should have minimum 8 characters") </script>';
    header("Location: ../Pages/SignUp.html");
}

if (empty($conpass)) {
    echo '<script> alert("Please enter your confirm password") </script>';
    header("Location: ../Pages/SignUp.html");
}

if ($pass != $conpass) {
    echo '<script> alert("Password and confirm password should match") </script>';
    header("Location: ../Pages/SignUp.html");
}

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["pic"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["pic"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["pic"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$filename = htmlspecialchars(basename($_FILES["pic"]["name"]));

include('connect.php');
$query = "INSERT INTO `users`(`name`, `regno`, `email`, `pic`, `phone`, `password`) VALUES ('$name','$rgd_no','$email', '$filename', '$phone','$pass')";
$retvalue = mysqli_query($conn, $query);
if ($retvalue) {
    header('Location: http://localhost/IWP-JCOMP/Script/dashboard.php');
} else {
    echo '<script> alert("Sign up failed due to some error in database updation...") </script>';
    echo '<script> alert("Sorry... please re-enter the details to signup")</script>';
    header('Location: http://localhost/IWP-JCOMP/SignUp.html');
}
