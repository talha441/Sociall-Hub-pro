<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $dir = "submissions";
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $filename = $dir . "/contact_" . time() . ".txt";
    $content = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message\n---\n";

    file_put_contents($filename, $content);

    header("Location: thankyou.html");
    exit();
} else {
    echo "Invalid Request";
}
?>
