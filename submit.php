<!DOCTYPE html>
<html>
<head>
  <title>Role selection</title>
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

//check if Login Information is correct
$username_entered = $_POST['username']; // replace with the input field name for the username
$pw_entered = $_POST['password']; // replace with the input field pw
$sql = "SELECT * FROM users WHERE user_password = '$pw_entered' AND user_name = '$username_entered'";
$result3 = mysqli_query($conn, $sql);

if (mysqli_num_rows($result3) > 0) {
  echo "<p class='class1'> Login Successful: Hello, " . $username_entered .  "</p>";
  $sql = "SELECT r.role_name FROM roles r INNER JOIN users u ON r.role_id = u.role_id WHERE u.user_name = '$username_entered'";
  $result4 = mysqli_query($conn, $sql);
  
  echo "<form method='post' class='form' action='second_page.php'>";
  echo "<p class='class1'> Roles: </p>";
  echo "<select name='selected_role' class='dropdown'>";
  while ($row = mysqli_fetch_assoc($result4)) {
    echo "<option value='" . $row["role_name"] . "'>" . $row["role_name"] . "</option>";
  }
  echo "</select>";

  echo "<input type='submit' name='submit' value='Continue'>";
  echo "</form>";
  
} else {
  echo "<p class='class2'> Login Failed: Username and/or Password is incorrect </p>";
  echo "<p class='class2'> Access Denied </p>";
}


mysqli_close($conn);
?>



</body>
</html>

