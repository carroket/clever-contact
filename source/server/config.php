<?php

/*============================================================================*\
	   ________                       ______            __             __
	  / ____/ /__ _   _____  _____   / ____/___  ____  / /_____ ______/ /_
	 / /   / / _ \ | / / _ \/ ___/  / /   / __ \/ __ \/ __/ __ `/ ___/ __/
	/ /___/ /  __/ |/ /  __/ /     / /___/ /_/ / / / / /_/ /_/ / /__/ /_
	\____/_/\___/|___/\___/_/      \____/\____/_/ /_/\__/\__,_/\___/\__/

	Configuration PHP for Clever Contact
	-----------------------------------------------------------------------
	© 2015 & 2016 by Carroket, Inc.
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

define('SENDER_NAME_MAX_LENGTH', 255);

define('SUBJECT_MAX_LENGTH', 60);
define('SUBJECT_PREFIX', 'Contact Form: ');

define('BODY_MAX_LENGTH', 65536);

define('MESSAGE_PREFIX', 'Someone has submitted the following message via the contact form at ' . CONTEXT_NAME .  ':');

define('ECHO_SUBMISSION', true);

define('VALID_EMAIL_ADDRESS_MIN_LENGTH', 1);
define('VALID_EMAIL_ADDRESS_MAX_LENGTH', 255);
define('VALID_EMAIL_ADDRESS_PATTERN', '/^[\A-Za-z\-\.]+[\A-Za-z\-\.+]*@([A-Za-z\-]+[\.])+[A-Za-z]{2,}$/');