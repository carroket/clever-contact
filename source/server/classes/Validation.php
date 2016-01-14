<?php

/*============================================================================*\
	   ________                       ______            __             __
	  / ____/ /__ _   _____  _____   / ____/___  ____  / /_____ ______/ /_
	 / /   / / _ \ | / / _ \/ ___/  / /   / __ \/ __ \/ __/ __ `/ ___/ __/
	/ /___/ /  __/ |/ /  __/ /     / /___/ /_/ / / / / /_/ /_/ / /__/ /_
	\____/_/\___/|___/\___/_/      \____/\____/_/ /_/\__/\__,_/\___/\__/

	Validation PHP for Clever Contact
	-----------------------------------------------------------------------
	© 2015 by Carroket, Inc.
	http://www.carroket.com/
	-----------------------------------------------------------------------
	Made by Brian Sexton.
	http://www.briansexton.com/
	-----------------------------------------------------------------------
	MIT License

\*============================================================================*/


class Validation
{
	public static function validate_user_input_format($value, $minimum_length, $maximum_length, $valid_pattern = NULL)
	{
		if (strlen($value) >= $minimum_length && strlen($value) <= $maximum_length && (is_null($valid_pattern) || preg_match($valid_pattern, $value)))
		{
			return true;
		}

		else
		{
			return false;
		}
	}
}