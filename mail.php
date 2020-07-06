

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