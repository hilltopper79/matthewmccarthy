

<?php
$subject = "Contact Form Submission from $fullName";
$fullName = $_POST['fullName'];
$mailFrom = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$mailTo = "jacob.f.brown1991@gmail.com";
$txt = "
<html>
    <body>
        <p>Contact Form Submission from $fullName</p>
        <br>
        <table>
            <tr>
                <td>Subject: </td>
                <td>$subject</td>
            </tr>
            <tr>
                <td>Request Name: </td>
                <td>$fullName</td>
            </tr>
            <tr>
                <td>Request Email: </td>
                <td>$mailFrom</td>
            </tr>
            <tr>
                <td>Message: </td>
                <td>$message</td>
            </tr>
        </table>
    </body>
</html>";

$headers = "From: $mailFrom\r\n";
$headers .= "Content-type: text/html\r\n";
$headers .= "Bcc: $mailFrom\r\n";

mail($mailTo, $subject, $txt, $headers);
header("Location: success.php");
?>

<?php
$subject = "Contact Form Submission from $fullName";
$fullName = $_POST['fullName'];
$mailFrom = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$mailTo = "jacob.f.brown1991@gmail.com";
$txt = "
<html>
    <body>
        <p>Contact Form Submission from $fullName</p>
        <br>
        <table>
            <tr>
                <td>Subject: </td>
                <td>$subject</td>
            </tr>
            <tr>
                <td>Request Name: </td>
                <td>$fullName</td>
            </tr>
            <tr>
                <td>Request Email: </td>
                <td>$mailFrom</td>
            </tr>
            <tr>
                <td>Message: </td>
                <td>$message</td>
            </tr>
        </table>
    </body>
</html>";

// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
// require 'vendor/autoload.php';
// Comment out the above line if not using Composer
require("./sendgrid-php-master/sendgrid-php.php");
// If not using Composer, uncomment the above line
$email = new \SendGrid\Mail\Mail();
$email->setFrom($mailFrom, $fullname);
$email->setSubject($subject);
$email->addTo($mailTo, "Jake Brown");
$email->addContent(
    "text/html", $txt
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}