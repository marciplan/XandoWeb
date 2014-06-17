<?php
/* Set e-mail recipient */
$myemail = "ik@marcianoplanque.nl";

/* Check all form inputs using check_input function */
$name = check_input($_POST['name'], "");
$name = check_input($_POST['company'], "");
$email = check_input($_POST['email']);
$name = check_input($_POST['telephone'], "");
$message = check_input($_POST['message'], "");
$subject = "Vraag via de Onderwijs website";

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
show_error("");
}
/* Let's prepare the message for the e-mail */
$message = "

Er is een bericht achtergelaten op de Onderwijs website. Hier is wat er ingevuld is: 

Naam: $name
School/Instelling: $company
E-mailadres: $email
Telefoonnummer: $telephone

Het bericht:
$message

Groetjes, je mailslaaf.

";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: verstuurd.php');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
if ($problem && strlen($data) == 0)
{
show_error($problem);
}
return $data;
}

function show_error($myError)
{
?>
<html>
<link rel="stylesheet" href="css/foundation.css">
<style>
p {margin-left: 20px; margin-top: 20px;}
</style>
<body>

<p>Uw e-mail is nog niet verzonden. <br>U dient alle velden in te vullen.</p>
<strong><?php echo $myError; ?></strong>
<p><a href="http://www.xando.nl/onderwijs/seminars/index.php#contact">&laquo; Ga terug naar het contactformulier</a></p>

</body>
</html>
<?php
exit();
}
?>