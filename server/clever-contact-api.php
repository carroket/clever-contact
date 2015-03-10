<?php

/*============================================================================*\
	   ________                       ______            __             __
	  / ____/ /__ _   _____  _____   / ____/___  ____  / /_____ ______/ /_
	 / /   / / _ \ | / / _ \/ ___/  / /   / __ \/ __ \/ __/ __ `/ ___/ __/
	/ /___/ /  __/ |/ /  __/ /     / /___/ /_/ / / / / /_/ /_/ / /__/ /_
	\____/_/\___/|___/\___/_/      \____/\____/_/ /_/\__/\__,_/\___/\__/

	PHP for Clever Contact
	-----------------------------------------------------------------------
	© 2015 by Carroket, Inc.
	http://www.carroket.com/
	-----------------------------------------------------------------------
	Made by Brian Sexton.
	http://www.briansexton.com/
	-----------------------------------------------------------------------
	MIT License

\*============================================================================*/


// Set deployment-specific options.

define('CONTEXT_NAME', 'your Web site');

define('FROM_NAME', 'Clever Contact');
define('FROM_EMAIL_ADDRESS', $_SERVER['SERVER_ADMIN']);

define('TO_NAME', 'Server Administrator');
define('TO_EMAIL_ADDRESS', $_SERVER['SERVER_ADMIN']);

define('SUBJECT_MAX_LENGTH', 60);
define('SUBJECT_PREFIX', 'Contact Form: ');

define('MESSAGE_PREFIX', 'Someone has submitted the following message via the contact form at ' . CONTEXT_NAME .  ':');

define('ECHO_SUBMISSION', true);


// Build the e-mail.

$honeypot_response_length = strlen($_POST['verification']);

$to = TO_NAME . '<' . TO_EMAIL_ADDRESS . '>';

$subject = SUBJECT_PREFIX . $_POST['subject'];

if (strlen($subject) > SUBJECT_MAX_LENGTH)
{
	$subject = substr($subject, 0, SUBJECT_MAX_LENGTH - 3) . "...";
}

$body = MESSAGE_PREFIX . "\r\n\r\n";

$body .= 'Honeypot Response: ' . ($honeypot_response_length > 0 ? $_POST['verification'] . ' (Characters: ' . $honeypot_response_length . ')' : 'None') . "\r\n\r\n";

$body .= 'Sender Name: ' . $_POST['sender-e-mail-address'] . "\r\n\r\n";
$body .= 'Sender E-Mail Address: ' . $_POST['sender-e-mail-address'] . "\r\n\r\n";
$body .= $_POST['body'];

$additional_headers = 'From: ' . FROM_NAME . '<' . FROM_EMAIL_ADDRESS . '>';


// Create a response array.

$response = array();


// Send the e-mail and add the result to the response array.

$response['accepted'] = mail($to, $subject, wordwrap($body, 70, "\r\n", true), $additional_headers);


// If requested, add the submission to the response array.

if ('ECHO_SUBMISSION')
{
	$response['submission'] = $_POST;
}


// Respond to the request in JSON format.

print json_encode($response);