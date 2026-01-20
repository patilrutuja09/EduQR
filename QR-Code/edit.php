<?php
include_once("connection.php");  // Including the database connection file
include_once("upload.php");

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];  // Get the ID of the record to be edited

    // Query to retrieve the record to edit
    $sql = "SELECT * FROM tblupload WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);  // Bind the 'id' as an integer
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Store the current data in variables to pre-populate the form
            $name = $row['name'];
            $prn = $row['prn'];
        } else {
            echo "Record not found.";
            exit();
        }

        mysqli_stmt_close($stmt);  // Close the prepared statement
    } else {
        echo "Error preparing query: " . mysqli_error($link);
        exit();
    }
} else {
    echo "No ID specified.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated data from the form
    $updated_name = $_POST['name'];
    $updated_prn = $_POST['prn'];
    
    //-----------------
    $target_dir = "uploads/";
    $countfiles = count($_FILES['uploadfile']['name']);
    $files="";
    for($i=0;$i<$countfiles;$i++) {
        $target_file = $target_dir . uniqid() . basename($_FILES["uploadfile"]["name"][$i]);
        $files = $files . $target_file . '~';
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"][$i], $target_file)) {
            // "The file ". htmlspecialchars( basename( $_FILES["uploadfile"]["name"][$i])). " has been uploaded.";
        } else {
            // echo "Sorry, there was an error uploading your file.";
        }
    }
    //-------------------

    // SQL query to update the record
    $update_sql = "UPDATE tblupload SET name = ?, prn = ?, screenshot = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $update_sql)) {
        mysqli_stmt_bind_param($stmt, "sssi", $updated_name, $updated_prn, $target_file, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: view.php?message=Record updated successfully");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($link);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing query: " . mysqli_error($link);
    }
}

mysqli_close($link);  // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: #2c3e50;
            padding: 10px;
        }

        .navbar a {
            color: white;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar a:hover {
            color: #3498db;
        }

        .container {
            padding: 40px;
            flex-grow: 1;
        }

        .footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        .footer a {
            color: #ecf0f1;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .edit-form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            animation: fadeIn 1s ease-in-out;
        }

        .edit-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-group button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #2980b9;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .edit-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">EduQR</a>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="edit-form">
            <h2>Edit Record</h2>

            <!-- Edit Form -->
            <form action="edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div class="form-group">
                    <label for="prn">PRN:</label>
                    <input type="text" name="prn" id="prn" value="<?php echo htmlspecialchars($prn); ?>" required>
                </div>
                <div class="form-group">
                    <label for="screenshot">QR-Code (Image):</label>
                    <input type="file" name="uploadfile[]" id="uploadfile[]" multiple>
                </div>
                <div class="form-group">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 EduQR. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
    </div>

</body>
</html>
