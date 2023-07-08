<?php

// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>


    <script>
        $(document).ready(function search() {
            $('.form input[type="text"]').on("keyup input", function() {
                /* Get input value on change */
                var input, filter, table, tr, td, i, txtValue, resultDropdown;

                // inputVal = $(this).val();
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                resultDropdown = $(this).siblings(".result");
                table = document.getElementById('employee-table');
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }

                /*
                if (inputVal.length) {
                    $.get("backend-search.php", {
                        term: inputVal
                    }).done(function(data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
                */
            });

            /*
            // Set search input value on click of result item
            $(document).on("click", ".result p", function() {
                $(this).parents(".form").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
            */
        });
    </script>

</head>

<body>

    <?php
    include('./view/nav-bar.php');
    ?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 row align-items-start">
                        <h2 class="col">Employees Details</h2>
                        <a href="./create.php" class="btn btn-success col"><i class="fa fa-plus"></i> Add New Employee</a>
                    </div>

                    <div class="form mt-3 mb-3">
                        <input type="text" id="myInput" onkeyup="search()" class="form-control form-input" placeholder="Search by name...">
                        <i class="fa fa-search"></i>
                        </input>
                        <!-- <div class="result"></div> -->
                    </div>

                    <?php
                    // Include config file
                    require_once('database.php');

                    // Attempt select query execution
                    $sql = "SELECT * FROM employees";
                    if ($result = $pdo->query($sql)) {

                        if ($result->rowCount() > 0) {
                            echo '<table id="employee-table" class="table">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Name</th>";
                            echo "<th>Address</th>";
                            echo "<th>Salary</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['salary'] . "</td>";
                                echo "<td>";
                                echo '<a href="./read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="./update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="./delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            

                            // Free result set
                            unset($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    }

                    // Close connection
                    unset($pdo);

                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php include('./view/footer.php'); ?>
</body>

</html>