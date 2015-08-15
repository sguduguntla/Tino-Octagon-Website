
 <?php

if ($_POST["submit"]) {
	$error = "";
	$result = '<div class="alert alert-success">Form submitted</div>';

	if (!$_POST['name']) {
		$error .= "<br/>Please enter your name!";
	}

	if (!$_POST['email']) {
		$error .= "<br/>Please enter your email!";
	}

	if (!$_POST['comment']) {
		$error .= "<br/>Please enter a comment!";
	}

	if ($_POST['email'] AND !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error .= "<br/> Please enter a valid email address";
	}

	if ($error) {
		$result = '<div class="alert alert-danger"><strong>There were error(s) in your form: </strong>' . $error . '</div>';
	} else {
		$receiver = "sreeharsha11@gmail.com";
		$subject = "Comment from website!";
		$body =

		"Name: " . $_POST['name'] .
		"\nFrom: " . $_POST['email'] .
		"\nComment: " . $_POST['comment'];

		$headers = "From: " . $_POST['email'];

		if (mail($receiver, $subject, $body, $headers) == 1) {
			$result = "<div class='alert alert-success'><strong>Thank you! </strong>I'll be in touch.</div>";
		} else {
			$result = "<div class='alert alert-success'><strong>Sorry, there was an error sending your message. Please try again later.</strong></div>";
		}
	}

}

?>
