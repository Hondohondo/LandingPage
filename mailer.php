<?php

//Get the form fields, remove html tags and whitespace.
$name = strip_tags(trim($_POST["name"]));
$name = str_replace(array("\r","\n"),array(" "," "),$name);
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
//$message = trim($_POST["message"]);
$country = trim($_POST["country"]);


//Check data
if(empty($name) OR empty($country) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: https://intensivejournal.org/landingpage/index.php?success=-1#form");
    exit;
}

//Set the recipient email address.
$recipient = "info@intensivejournal.org, mnandi19@jcu.edu";

//Set the email subject
$subject = "New Facebook Ad Contact from $name";

//Build the email content
$email_content = "Name: $name\n";
$email_content .= "Email: $email\n\n";
$email_content .= "State or Country: \n$country\n";

//Build the email headers
$email_headers = "From: $name <$email>";

//Send the email
mail($recipient, $subject, $email_content, $email_headers);

//Redirect to the index.php page with success code
header("Location: https://intensivejournal.org/landingpage/index.php?success=1#form")

?>
