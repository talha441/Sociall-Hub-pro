<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $platform = htmlspecialchars($_POST['platform']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $details = htmlspecialchars($_POST['details']);

    // ডিরেক্টরি না থাকলে তৈরি করো
    $dir = "submissions";
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $filename = $dir . "/recovery_" . time() . ".txt";
    $content = "Platform: $platform\nName: $name\nEmail: $email\nUsername: $username\nDetails: $details\n---\n";

    file_put_contents($filename, $content);

    // সাবমিশন সফল হলে redirect
    header("Location: thankyou.html");
    exit();
} else {
    echo "Invalid Request";
}
?>
