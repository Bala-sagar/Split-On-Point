<html>
    <head>
        <link rel="stylesheet" href="../Styles/navbar.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid ps-5">
                <a class="navbar-brand" href="#"><img src="../Assets/logo.png" id="img1" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../Script/dashboard.php">
                                <b>Home</b>
                            </a>
                        </li>
                        <div id="abcd">
                            <li>
                                <img id="img1" src="../Assets/profile.png" alt="">
                            </li>
        
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <b><?php echo $_SESSION['name'] ?></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                                </ul>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>