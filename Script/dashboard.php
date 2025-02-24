<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../Styles/dashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>

<body>
<?php
    session_start();
    if(!isset($_SESSION['regno'])){
        header("Location: ../Pages/Login.html");
    }
    $reg_no = $_SESSION['regno'];

    include('connect.php');

    $res1 = $conn->query("SELECT * FROM activities WHERE sender_id = '$reg_no' AND settled = 0");
    $res2 = $conn->query("SELECT * FROM activities WHERE reciever_id = '$reg_no' AND settled = 0");

    $total_owed = 0;
    $total_are_owed = 0;

    if($res1->num_rows > 0) {
        while($row = $res1->fetch_assoc()){
            $row1[] = $row;
        }
        foreach($row1 as $row) {
            $total_owed += $row['amount'];
        }
    }
    if($res2->num_rows > 0) {
        while($row = $res2->fetch_assoc()){
            $row2[] = $row;
        }
        foreach($row2 as $row) {
            $total_are_owed += $row['amount'];
        }
    }

    $conn->close();

    include('navbar.php');
?>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="leftDiv col-3">
                <div class="d-flex flex-column py-5 justify-content-center align-items-center">
                    <button type="button" class="btn red w-75 text-black" data-bs-toggle="modal" data-bs-target="#addExpenseModal"><h5 class="my-1">Add Expense</h5></button>
                    <form action="settleExpense.php" method="POST" class="w-75">
                        <input type="hidden" name="actid" id="actid">
                        <input type="submit" class="btn green mt-4 text-black w-100 fs-5 fw-semibold" value="Settle Expense">
                    </form>

                    <!-- Add Expense Modal -->
                    <div class="modal" tabindex="-1" id="addExpenseModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="addExpense.php" method="post">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title">Add Expense</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="input-group mb-4">
                                            <span class="input-group-text">Add Others</span>
                                            <input type="text" class="form-control" placeholder="Regno or Email" aria-label="Username" name="members" style="text-transform: uppercase" id="mem">
                                        </div>
                                        <div class="input-group mb-4">
                                            <textarea class="form-control" aria-label="With textarea" placeholder="Description" name="desc"></textarea>
                                        </div>
                                        <div class="input-group mb-4">
                                            <span class="input-group-text">₹</span>
                                            <input type="text" class="form-control" placeholder="0.00" aria-label="Username" name="amount" id="amount">
                                        </div>
                                        <p class="text-center h6">Paid by you and split equally</p>
                                        <h5 class="text-center" id="amountText">₹ 0.0 / person</h5>
                                        <div class="input-group my-4">
                                            <span class="input-group-text">Date</span>
                                            <input type="date" class="form-control" aria-label="Username" name="date">
                                        </div>
                                        <input type="hidden" name="reciever_id" id="sid" value="">
                                        <input type="hidden" name="perPerson" id="perPerson" value="">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <input type="submit" class="btn red" value="Save"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Total Expense -->
                <div class="d-flex flex-column me-3 ps-4">
                    <div class="h4 d-flex flex-row justify-content-between mt-5">
                        <div>
                            You Owe :
                        </div>
                        <div class="text-danger">
                            ₹ <?php echo $total_owed; ?>
                        </div>
                    </div>
                    <div class="h4 d-flex flex-row justify-content-between mt-5">
                        <div>
                            You are Owed :
                        </div>
                        <div class="text-success">
                            ₹ <?php echo $total_are_owed; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rigthDiv col d-flex flex-row justify-content-evenly pt-3">
                <!-- You Owe -->
                <div class="d-flex flex-column align-items-center w-100 mx-5">
                    <div class="h3">YOU OWE</div>
                    <hr class="border bg-black w-100">
                    <?php
                        if($res1->num_rows > 0) {
                            foreach($row1 as $row)
                            {
                                $date1 = date("Y-m-d");
                                $date2 = date_create($row['date']);
                                $diff = date_diff(date_create($date1), $date2);
                                $diff = $diff->format("%a");
                    ?>
                    <div class="mt-3 prof rounded-4 w-100 expense" onclick="handleSelect(<?php echo $row['id'] ?>)">
                        <div class="d-flex flex-row ms-5">
                            <img src="../Assets/default.png" style="border-radius: 50%; width: 100px; height: 100px;">
                            <div class="d-flex flex-column mx-4 w-100">
                                <h4 class="mt-3"><?php echo $row["reciever_name"]; ?></h4>
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <p class="h6 text-danger m-0">You owe ₹<?php echo $row["amount"]; ?></p>
                                    <p class="m-0 fw-bold text-muted"><?php echo "$diff " ?>Days Ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>

                <div class="vr"></div>

                <!-- You Are Owed -->
                <div class="d-flex flex-column align-items-center w-100 mx-5">
                    <div class="h3">YOU ARE OWED</div>
                    <hr class="border bg-black w-100">
                    <?php
                        if($res2->num_rows > 0) {
                            foreach($row2 as $row)
                            {
                                $date1 = date("Y-m-d");
                                $date2 = date_create($row['date']);
                                $diff = date_diff(date_create($date1), $date2);
                                $diff = $diff->format("%a");
                    ?>
                    <div class="mt-3 prof px-3 rounded-4 w-100">
                        <div class="d-flex flex-row ms-5">
                            <img src="../Assets/default.png" style="border-radius: 50%; width: 100px; height: 100px;">
                            <div class="d-flex flex-column mx-4 w-100">
                                <h4 class="mt-3"><?php echo $row["sender_name"]; ?></h4>
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <p class="h6 text-success m-0">Owes you ₹<?php echo $row["amount"]; ?></p>
                                    <p class="m-0 fw-bold text-muted"><?php echo "$diff " ?>Days Ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous">
    </script>
    <script src="dashboard.js"></script>
</body>
</html>
