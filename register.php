<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST["name"]);
  $email = htmlspecialchars($_POST["email"]);
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  if (!is_dir("users")) {
    mkdir("users", 0777, true);
  }

  $file = "users/" . md5($email) . ".txt";
  file_put_contents($file, "$name|$email|$password");

  header("Location: login.html");
  exit();
}
?>
