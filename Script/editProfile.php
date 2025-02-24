<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <title>Edit Profile</title>
    <style>
        body{
            background-color: cyan;
        }
        h2 {
            margin-left: 600px;
        }
        td {
            padding: 10px;
        }
        ::selection{
            background-color: black;
            color: white;
        }

        .main {
            margin: 40px 500px;
            border: 2px solid blueviolet;
            border-radius: 35px;
            width: fit-content;
            padding: 20px;
            background-color: yellow;
        }
        input{
            border-radius: 5px;
            border-color: grey;
            border-top : 0px;
            border-left: 0px;
            border-right: 0px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <?php
    session_start() ;
        include('connect.php');
        $regno = $_SESSION['regno'];
 
        $query = "SELECT * FROM users WHERE regno = '$regno'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
    ?>

    <h2 style="margin-top:40px"> Edit profile </h2>
    <div class="main">
        <form action="updateProfile.php" method="POST">
            <table>
                <tr>
                    <td> <?php echo "Registartion No"; ?> </td>
                    <td> <?php echo $regno; ?> </td> <!--  use session variables -->
                </tr>
                <tr>
                    <td> <?php echo "Name"; ?> </td>
                    <td> <?php echo "<input type='text' name='name' value='". $row['name'] . "'/>"; ?> </td> <!--  use session variables -->
                </tr>
                <tr>
                    <td> <?php echo "Email"; ?> </td>
                    <td> <?php echo "<input type='email' name='email' value='". $row['email'] . "'/>"; ?> </td> <!--  use session variables -->
                </tr>
                <tr>
                    <td> <?php echo "Phone"; ?> </td>
                    <td> <?php echo "<input type='text' name='phone' value='". $row['phone'] . "'/>" ?> </td> <!--  use session variables -->
                </tr>
                <tr align="center">
                    <td colspan="2"> <input type="submit" class="btn btn-danger" value="Save Changes" style="margin-left: 20px;"> </td>
                </tr>
            </table>

        </form>
    </div>
</body>

</html>