
<?php
include_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Get the email and password from the POST data
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Query to check if a user with the provided email and password exists
        $query = "SELECT * FROM `tblregister` WHERE email = '$email' AND pass = '$pass'";
        $result = mysqli_query($link, $query);

        // Initialize response array
        $res = array();

        // Check if the query was successful and if any rows match
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // User found, login successful
                $res['result'] = 1;
                echo json_encode($res);  // Send success response

                
                header("Location:home.html");
                exit();
            } else {
                $res['result'] = 2;
                echo json_encode($res);  // Send invalid login response
            }
        } else {
            // Query failed
            $res['result'] = 0;
            echo json_encode($res);  // Send error response
        }
    }
}
?>

