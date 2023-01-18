<?php

$api = 'b415da2f5e270fefe036c95e8d88f0c9-f7d687c0-6395611b';
$url = 'https://api.mailgun.net/v3/mazanlabeeb.tech/messages';
$from = 'admin@mazanlabeeb.tech';
$to = 'lahrasab.ramzan36@gmail.com';


// define variables and set to empty values
$fname = $email = $lname = $phone = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = test_input($_POST["fname"]);
    $lname = test_input($_POST["lname"]);
    $email = test_input($_POST["email"]);
    $message = test_input($_POST["message"]);
    $phone = test_input($_POST["phone"]);


    $email_body = "Name: " . $fname . $lname . "\nEmail:" . $email . "\nphone:" . $phone . "\n\nMessage:" . $message;


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    $post = array(
        'from' => $from,
        'to' => $to,
        'subject' => 'Contact',
        'text' => $email_body
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_USERPWD, 'api' . ':' . $api);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo "Thanks for sending us Query. We shall contact you soon. Redirecting in 4 seconds...";
        header("refresh:4;url=index.php");
    }
    curl_close($ch);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
