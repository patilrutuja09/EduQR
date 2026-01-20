<?php
include_once("connection.php");  // Including the database connection file
include_once("upload.php");

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];  // Get the ID of the record to be deleted

    // SQL query to delete the record (use placeholder for id)
    $sql = "DELETE FROM tblupload WHERE id = ?";  // Use '?' as a placeholder for the id

    // Prepare the statement
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind the 'id' parameter to the prepared statement
        mysqli_stmt_bind_param($stmt, "i", $id);  // "i" indicates that the parameter is an integer

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // If successful, redirect to the main page
            header("Location: view.php?message=Record deleted successfully");
            exit();  // Stop further script execution after the redirect
        } else {
            // If there was an error executing the query
            echo "Error deleting record: " . mysqli_error($link);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // If there was an error preparing the query
        echo "Error preparing the query: " . mysqli_error($link);
    }
} else {
    // If 'id' is not provided in the URL, show an error message
    echo "No record ID specified for deletion.";
}

mysqli_close($link);  // Close the database connection
?>
