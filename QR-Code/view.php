<?php
include_once("connection.php"); // Including the database connection file
include_once("upload.php");

// Query to retrieve data
$sql = "SELECT * FROM tblupload";  // Replace 'tblupload' with the name of your table
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    /* General Body Styling */
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f6f9;
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    h2 {
      text-align: center;
      margin-top: 30px;
      font-size: 2rem;
      color: #333;
    }

    .container {
      width: 80%;
      margin: 20px auto;
      flex-grow: 1;
    }

    /* Table Styling */
    .data-table {
      width: 100%;
      margin-top: 30px;
      border-collapse: collapse;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      overflow-x: auto;
      border-radius: 8px;
      border: 1px solid #ddd; /* Added border to table */
    }

    .data-table thead {
      background-color: #3498db;
      color: #fff;
    }

    .data-table th,
    .data-table td {
      padding: 12px;
      text-align: center;
      border: 1px solid #ddd; /* Border around each cell */
      font-size: 1rem;
    }

    .data-table th {
      font-size: 1.2rem;
    }

    .data-table tbody tr {
      transition: background-color 0.3s ease-in-out;
    }

    /* Hover Effect for Table Rows */
    .data-table tbody tr:hover {
      background-color: #f4f6f9;
      cursor: pointer;
    }

    /* Striped Rows for Better Readability */
    .data-table tbody tr:nth-child(odd) {
      background-color: #f9f9f9;
    }

    /* Image Styling for QR Code */
    .data-table img {
      max-width: 100px;
      height: auto;
      cursor: pointer;
    }

    /* Attractive Actions Column Styling */
    .data-table .actions a {
      text-decoration: none;
      padding: 10px 20px;
      margin: 5px;
      font-weight: bold;
      border-radius: 30px; /* Rounded buttons */
      transition: all 0.3s ease-in-out;
      display: inline-block;
    }

    /* Edit Button Styles */
    .data-table .actions .edit {
      color: #fff;
      background-color: #28a745;
      border: 2px solid #28a745;
    }

    /* Delete Button Styles */
    .data-table .actions .delete {
      color: #fff;
      background-color: #dc3545;
      border: 2px solid #dc3545;
    }

    /* Hover Effects for Buttons */
    .data-table .actions a:hover {
      transform: translateY(-5px); /* Slight upward movement on hover */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .data-table .actions .edit:hover {
      background-color: #218838;
      border-color: #218838;
    }

    .data-table .actions .delete:hover {
      background-color: #c82333;
      border-color: #c82333;
    }

    /* Navbar Styles */
    .navbar {
      background-color: #2c3e50;
    }

    .navbar-brand img {
      width: 60px;
      border-radius: 50%;
    }

    .navbar-nav a {
      color: #fff;
      padding: 10px 15px;
      text-decoration: none;
      font-weight: bold;
    }

    .navbar-nav a:hover {
      background-color: #34495e;
      border-radius: 5px;
    }

    /* Footer Styles */
    .footer {
      background-color: #2c3e50;
      color: white;
      padding: 20px 0;
      text-align: center;
      font-size: 0.9rem;
      margin-top: 40px;
      position: relative;
      bottom: 0;
      width: 100%;
    }

    .footer a {
      color: #ecf0f1;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    /* Make the table responsive */
    @media screen and (max-width: 768px) {
      .data-table {
        width: 100%;
      }

      .data-table th,
      .data-table td {
        font-size: 0.9rem;
        padding: 8px;
      }

      .data-table .actions a {
        padding: 6px 10px;
      }
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-sm navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">
        <img src="img/logo.GIF" alt="EduQR Logo"> EduQR
      </a>
      <div class="navbar-nav ms-auto">
        <a href="aboutUs.html" class="nav-link">About Us</a>
        <a href="services.html" class="nav-link">Our Services</a>
        <a href="contact.html" class="nav-link">Contact</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container">
    <h2>Data from Database</h2>

    <!-- Data Table -->
    <div style="overflow-x: auto;">
      <table class="data-table">
        <thead>
          <tr>
            <th>PRN No</th>
            <th>Name of Student</th>
            <th>QR-Code</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (mysqli_num_rows($result) > 0) {
            // Output data for each row
            while ($row = mysqli_fetch_assoc($result)) {
              // Assuming "screenshot" contains the path to the image (e.g., "uploads/image.jpg")
              $screenshot_path = $row["screenshot"]; // The path to the image file

              echo "<tr>";
              echo "<td>" . htmlspecialchars($row["prn"]) . "</td>";
              echo "<td>" . htmlspecialchars($row["name"]) . "</td>";

              // Display the image using the 'img' tag and add a click event to open the modal
              echo "<td><img src='$screenshot_path' alt='QR-Code' data-bs-toggle='modal' data-bs-target='#imageModal' data-bs-src='$screenshot_path'></td>";

              // Edit and Delete links in an actions column
              echo "<td class='actions'>
                        <a href='edit.php?id=" . $row["id"] . "' class='edit'>Edit</a> 
                        | 
                        <a href='delete.php?id=" . $row["id"] . "' class='delete'>Delete</a>
                    </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='4' class='no-data'>No data found</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Image Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">QR Code</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img id="modalImage" src="" alt="QR Code" class="img-fluid">
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    <p>&copy; 2025 EduQR. All rights reserved.</p>
    <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
  </div>

  <script>
    // Set the image source for the modal when an image is clicked
    var qrImages = document.querySelectorAll('img[data-bs-toggle="modal"]');
    qrImages.forEach(function(img) {
      img.addEventListener('click', function() {
        var imgSrc = img.getAttribute('data-bs-src');
        var modalImage = document.getElementById('modalImage');
        modalImage.src = imgSrc; // Set the source of the modal image
      });
    });
  </script>

</body>

</html>
