<?php
        session_start();
        include('connect.php');

        $members = $_POST['members'];
        $amount = $_POST['amount'];
        $description = $_POST['desc'];
        $date = $_POST['date'];
        $perPerson = $_POST['perPerson'];

        // Recieve from session
        $reciever_id = $_SESSION['regno'];
        $reciever_name = $_SESSION['name'];

        $mem_ids = explode(" ", $members);
        foreach ($mem_ids as $mem_id) {
            $res = $conn->query("SELECT * FROM users WHERE regno = '$mem_id'");
            $mem_names[] = $res->fetch_assoc()['name'];
        }

        for ($i = 0; $i < count($mem_ids); $i++) {
            $sql = "INSERT INTO activities (sender_id, sender_name, reciever_id, reciever_name, amount, description, date) VALUES ('$mem_ids[$i]', '$mem_names[$i]', '$reciever_id', '$reciever_name', '$perPerson', '$description', '$date')";
            $result = $conn->query($sql);
        }
        header("Location: http://localhost/IWP-JComp/Script/dashboard.php");
        $conn->close();
?>