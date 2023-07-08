<?php

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>

<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0  ml-auto">

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">
                        <div class="icon">
                            <i class="fa fa-home" aria-hidden="true"></i><!-- this is home icon link get form fornt-awesome icon for home button -->
                        </div>
                        <div class="name"><span data-text="Home">Home</span></div>
                    </a>
                </li>
                <li>
                    <a class="nav-link" aria-current="page" href="register.php">
                        <div class="icon">
                            <i class="fa fa-sign-in" aria-hidden="true"></i><!-- this is home icon link get form fornt-awesome icon for home button -->
                        </div>
                        <div class="name"><span data-text="Register">Register</span></div>
                    </a>
                </li>
                <li>
                    <a class="nav-link" aria-current="page" href="reset-password.php">
                        <div class="icon">
                            <i class="fa fa-key" aria-hidden="true"></i><!-- this is home icon link get form fornt-awesome icon for home button -->
                        </div>
                        <div class="name"><span data-text="Reset Password">Reset Password</span></div>
                    </a>
                </li>
                <li>
                    <a class="nav-link" aria-current="page" href="logout.php">
                        <div class="icon">
                            <i class="fa fa-sign-out" aria-hidden="true"></i><!-- this is home icon link get form fornt-awesome icon for home button -->
                        </div>
                        <div class="name"><span data-text="Logout">Logout</span></div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>