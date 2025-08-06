<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $file = "users/" . md5($email) . ".txt";

  if (file_exists($file)) {
    $data = explode("|", file_get_contents($file));
    if (password_verify($password, $data[2])) {
      $_SESSION["name"] = $data[0];
      $_SESSION["email"] = $data[1];
      header("Location: dashboard.html");
      exit();
    }
  }
  echo "Login failed!";
}
?>
