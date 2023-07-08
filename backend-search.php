<?php

// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once('database.php');
 
// Attempt search query execution
try{
    if(isset($_REQUEST["term"])) {
        // create prepared statement
        $sql = "SELECT * FROM employees WHERE name LIKE :term";
        $stmt = $pdo->prepare($sql);
        $term = '%' . $_REQUEST["term"] . '%';
        
        // bind parameters to statement
        $stmt->bindParam(":term", $term);
        
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()) {
                echo "<p>" . $row["name"] . "</p>";
            }
        } 
        else{
            echo "<p>No matches found</p>";
        }
    }  
} 
catch(PDOException $e) {
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close statement
unset($stmt);
 
// Close connection
unset($pdo);
