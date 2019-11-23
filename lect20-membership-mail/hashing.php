<?php

$to = "nayeonki@usc.edu";
$subject = "Hello from ITP 303!";
$message = "Hi Nayeon, I'm sending this from ITP 303. Your final project is due on <strong>Dec 13th</strong> :) ";
$headers = "Content-Type: text/html" . "\r\n" . "From:obama@gmail.com";

// Can send emails via PHP
if( mail($to, $subject, $message, $headers) ) {
	// Doesn't guarantee email has actually been received. Email clients can reject any emails or put it in spam etc if they see any suspicious activity.
	echo "Email sent";
}
else {
	echo "There was a problem sending email.";
}


?>