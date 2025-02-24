<?php
    session_start();
    include('connect.php');

    $rgd = $_POST['rgd'];
    $pass = $_POST['psw'];

    $query = 'SELECT * FROM users WHERE regno="' . $rgd . '";';
    $res = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($res);
    if ($rows == 1) {
        $user = mysqli_fetch_assoc($res);
        if ($user['password'] == $pass) {
            $_SESSION['regno'] = $rgd;
            $_SESSION['name'] = $user['name'];
            $test = $_SESSION['regno'];
            echo "<script>
                localStorage.setItem('regno', JSON.stringify('$rgd'));
            </script>";
            header("Location: http://localhost/IWP-JComp/Script/dashboard.php");
        }
        else
        {
            echo "User exists but entered incorrect password";
        }
    } else {
        echo "<script> User not found </script>";
        header("Location: http://localhost/IWP-JComp/Pages/login.html");
    }
    $conn->close();
?>