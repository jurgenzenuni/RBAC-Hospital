<!DOCTYPE html>
<html>
<head>
  <title>Permissions</title>
  <link rel="stylesheet" href="styles2.css">
</head>
<body>

<?php
//Connecting php to the database
$servername = "sql207.epizy.com"; 
$username = "epiz_33865080"; 
$password = "fKWdGxaoUlVEzaP"; 
$dbname = "epiz_33865080_Hospital1"; 

// connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
  $selected_role = $_POST['selected_role'];
  $sql = "SELECT DISTINCT p.permission_name FROM permissions p 
        JOIN role_permissions rp ON p.permission_id = rp.permission_id 
        JOIN roles r ON r.role_id = rp.role_id 
        JOIN users u ON u.role_id = r.role_id 
        WHERE r.role_name = '$selected_role'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo "<p class='class3'> Access Granted </p>";
    echo "<p class='class1'>Permissions:</p>";
    echo "<select name='permissions' class='dropdown'>";
   while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row["permission_name"] . "'>" . $row["permission_name"] . "</option>";
   }
   echo "</select>";
  } else {
    echo "<p class='class2'> Access Denied </p>";
    }
} else {
  echo "<p>Error: Submit button not clicked.</p>";
}

mysqli_close($conn);
?>



</body>
</html>