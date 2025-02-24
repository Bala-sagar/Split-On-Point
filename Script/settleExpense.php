<?php 
    include('connect.php');

    $ids = $_POST['actid'];
    $ids = explode(" ", $ids);

    foreach ($ids as $id) {
        $sql = "UPDATE activities SET settled = 1 WHERE id = '$id'";
        $result = $conn->query($sql);
    }

    header("Location: http://localhost/IWP-JComp/Script/dashboard.php");
    $conn->close();
?>