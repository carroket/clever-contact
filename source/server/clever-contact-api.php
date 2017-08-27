<?php

/*============================================================================*\
	   ________                       ______            __             __
	  / ____/ /__ _   _____  _____   / ____/___  ____  / /_____ ______/ /_
	 / /   / / _ \ | / / _ \/ ___/  / /   / __ \/ __ \/ __/ __ `/ ___/ __/
	/ /___/ /  __/ |/ /  __/ /     / /___/ /_/ / / / / /_/ /_/ / /__/ /_
	\____/_/\___/|___/\___/_/      \____/\____/_/ /_/\__/\__,_/\___/\__/

	PHP for Clever Contact
	-----------------------------------------------------------------------
	© 2015-2017 by Carroket, Inc.
	https://carroket.com/
	-----------------------------------------------------------------------
	Made by Brian Sexton.
	https://briansexton.com/
	-----------------------------------------------------------------------
	MIT License

\*============================================================================*/


if (!@include_once('./config.php'))
{
	header('Content-Type: text/plain');

	exit('Error: A necessary file could not be loaded.');
}


if (!@include_once('./classes/Validation.php'))
{
	header('Content-Type: text/plain');

	exit('Error: A necessary file could not be loaded.');
}


// Validate the user input.

$validation_results = validate_user_input($_POST);


// Build the e-mail.

$honeypot_response_length = strlen($_POST['verification']);

$to = TO_NAME . ' <' . TO_EMAIL_ADDRESS . '>';

$subject = SUBJECT_PREFIX . $_POST['subject'];

if (strlen($subject) > SUBJECT_MAX_LENGTH)
{
	$subject = substr($subject, 0, SUBJECT_MAX_LENGTH - 3) . "...";
}

$body = MESSAGE_PREFIX . "\r\n\r\n";

$body .= 'Honeypot Response: ' . ($honeypot_response_length > 0 ? $_POST['verification'] . ' (Characters: ' . $honeypot_response_length . ')' : 'None') . "\r\n\r\n";

$body .= 'Sender Name: ' . $_POST['sender-name'] . "\r\n\r\n";
$body .= 'Sender E-Mail Address: ' . $_POST['sender-e-mail-address'] . "\r\n\r\n";
$body .= $_POST['body'];

$additional_headers = 'From: ' . FROM_NAME . ' <' . FROM_EMAIL_ADDRESS . '>';


// Create a response array.

$response = array();


/*
	If all of the user input passed validation, try to send the e-mail and add
	the result of the attempt to the response array.

	Otherwise, add the validation results to the response array so the client
	can respond accordingly.
*/

if ($validation_results['summary']['invalidCount'] === 0)
{
	$response['inputValidated'] = true;

	$response['accepted'] = mail($to, $subject, wordwrap($body, 70, "\r\n", true), $additional_headers);
}

else
{
	$response['inputValidated'] = false;

	$response['validationResults'] = $validation_results;
}


// If requested, add the submission to the response array.

if ('ECHO_SUBMISSION')
{
	$response['submission'] = $_POST;
}


// Respond to the request in JSON format.

header('Content-Type: application/json');

print json_encode($response);


// E-Mail Address Validation Function

function validate_user_input($input)
{
	$details = [];

	$summary =
	[
		'validCount' => 0,

		'invalidCount' => 0
	];

	foreach ($input as $key => $value)
	{
		if ($key === 'sender-name')
		{
			$result = Validation::validate_user_input_format($value, 1, SENDER_NAME_MAX_LENGTH);

			$details[] =
			[
				'formElementName' => $key,

				'friendlyName' => 'Name',

				'result' => $result
			];

			if ($result === true)
			{
				$summary['validCount']++;
			}

			else
			{
				$summary['invalidCount']++;
			}
		}

		elseif ($key === 'sender-e-mail-address')
		{
			$result = Validation::validate_user_input_format($value, VALID_EMAIL_ADDRESS_MIN_LENGTH, VALID_EMAIL_ADDRESS_MAX_LENGTH, VALID_EMAIL_ADDRESS_PATTERN);

			$details[] =
			[
				'formElementName' => $key,

				'friendlyName' => 'E-Mail Address',

				'result' => $result
			];

			if ($result === true)
			{
				$summary['validCount']++;
			}

			else
			{
				$summary['invalidCount']++;
			}
		}

		elseif ($key === 'subject')
		{
			$result = Validation::validate_user_input_format($value, 1, SUBJECT_MAX_LENGTH);

			$details[] =
			[
				'formElementName' => $key,

				'friendlyName' => 'Subject',

				'result' => $result
			];

			if ($result === true)
			{
				$summary['validCount']++;
			}

			else
			{
				$summary['invalidCount']++;
			}
		}

		elseif ($key === 'body')
		{
			$result = Validation::validate_user_input_format($value, 1, BODY_MAX_LENGTH);

			$details[] =
			[
				'formElementName' => $key,

				'friendlyName' => 'Body',

				'result' => $result
			];

			if ($result === true)
			{
				$summary['validCount']++;
			}

			else
			{
				$summary['invalidCount']++;
			}
		}
	}

	return ['summary' => $summary, 'details' => $details];
}