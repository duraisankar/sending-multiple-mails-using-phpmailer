<?php
require_once 'mailer/class.phpmailer.php';
// creates object
$mail = new PHPMailer(true);

global $con;
$con=mysqli_connect("localhost","user","password","db name");



$subject    = "Confirmation Regarding your registration";




// HTML email ends here

$mail->isHTML(true);
$mail->SMTPDebug  = 0;
$mail->SMTPAuth   = true;
$mail->SMTPSecure = "ssl";
$mail->Host       = "your smpt server";
$mail->Port       = 465;
$mail->Username   ="welcome@domain.in";
$mail->Password   ="passwrd";
$mail->SetFrom('welcome@domain.in','Name');
$mail->AddReplyTo("helpdesk@domain.in","Name");





if(isset($_POST['submit']))
{
    $message=$_POST['message'];
    $sql="select name,email from `user`";
    $result=mysqli_query($con,$sql) or die(mysqli_error($con));
    while($row=mysqli_fetch_row($result))
    {


        $mail->AddAddress("$row[1]");

        $mail->Subject    = $subject;
        $mail->Body 	  = $message;
        $mail->AltBody    = $message;


        $mail->Send();
        $mail->clearAddresses();
        echo "success";
    }

}
?>
<html>
<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
<form action="" method="post">
    <textarea name="message" ></textarea>

    <input type="submit" name="submit" value="submit" />
</form>
</body>
</html>
