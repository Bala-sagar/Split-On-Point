<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Styles/profile.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['regno'])) {
        header("Location: ../Pages/Login.html");
    }
    $regno = $_SESSION['regno'];
    include('navbar.php');

    include('connect.php');

    $query = "select * from users where regno='" . $regno . "';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="main">
        <div class="left">
            <div style="margin-top: 3rem;">
                <img src="../uploads/<?php echo $row['pic'];?>" alt="">
            </div>
            <br>
            <div id="details_container">
                <table class="styled-table">
                    <tr>
                        <td> Name </td>
                        <td> <?php echo $row['name'];?> </td>
                    </tr>
                    <tr>
                        <td> Registration No </td>
                        <td> <?php echo $row['regno'];  ?> </td>
                    </tr>
                    <tr>
                        <td> Email </td>
                        <td> <?php echo $row['email'];?> </td>
                    </tr>
                    <tr>
                        <td> Phone </td>
                        <td> <?php echo $row['phone'];?> </td>
                    </tr>
                    <tr>
                        <td> Account Created On </td>
                        <td> <?php echo substr($row['createdAt'], 0, 10)  ?> </td>
                    </tr>

                </table>
                <a href="editProfile.php"> 
                    <input type="button" value="Edit profile" id="edit" class="btn btn-primary">
                </a>
            </div>
        </div>

        <div class="right">
            <h2 align="center" style="margin-top: 20px"> Activites </h2>
            <?php
            $send_amount = 0;
            $receive_amount = 0;
            $regno = $_SESSION['regno'];
            $query = "select * from activities where sender_id='$regno' ORDER BY date DESC";
            $query2 = "select * from activities where reciever_id='$regno' ORDER BY date DESC";
            $res = mysqli_query($conn, $query);
            $res2 = mysqli_query($conn, $query2);
            ?>
            <table class='styled-table'>
                <tr> 
                    <td> From/To </td> 
                    <td> Activity Description </td> 
                    <td> Amount </td> 
                    <td> Date </td> 
                    <td>Settled</td>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($res)) {
                    $send_amount += $row['amount'];
                    ?>
                    <tr> 
                        <td><?php echo $row['reciever_id'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td style='color:red'><?php echo $row['amount'] ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td><?php 
                        if($row['settled']) 
                            echo "Yes";
                        else
                            echo "No";
                        ?></td>
                    </tr>
                <?php
                }

                while ($row = mysqli_fetch_assoc($res2)) {
                    $receive_amount += $row['amount'];
                    ?>
                    <tr> 
                        <td><?php echo $row['sender_id'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td style='color:green'><?php echo $row['amount'] ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td><?php 
                        if($row['settled']) 
                            echo "Yes";
                        else
                            echo "No";
                        ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>