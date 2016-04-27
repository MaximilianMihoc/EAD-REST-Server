<?php

class Validation
{
	/**
    * Validates the email address passed as string parameter.
    * @param Strin $email String containing email address.
    * @return Bool Returns true if email is valid.
    */
	public function isValidEmail($email)
	{
		/*$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

		if (preg_match($pattern, $email) === 1) {
		    return true;
		}

		return false;*/

		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	/**
    * Checking if number is in the given range.
    *
    * @param int $number contains checking number.
    * @param int $min contains minimum value.
    * @param int $max contains maximum value.
    *
    * @return Bool Returns true if number is in the range.
    */
	public function isNumberInRangeValid($number, $min, $max)
	{
		if(is_numeric($number) && is_numeric($min) && is_numeric($max))
		{
			if(($min <= $number) && ($number <= $max) && ($min < $max))
			{
				return true;
			}
		}

		return false;
	}

	/**
    * Checking if length of given string is less or equal than given number.
    *
    * @param String $str contains checking word.
    * @param int $num contains given value.
    *
    * @return Bool Returns true if length of the sting is less or equal than given number.
    */
	public function isLengthStringValid($string, $x)
	{
		if (is_string($string) && is_numeric($x))
		{
			$len = strlen($string);
			if($len <= $x) return true;
		}
		return false;
	}
	/**
	 * 
	 * Check is date format is correct: YYYY-MM-DD
	 * @param $date - the input date
	 * @return Bool indicating if the date format is valid or not
	 */
	public function isDateFormatValid($date){
		$regex = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
		if (preg_match($regex, $date)) {
	        return true;
	    } else {
	        return false;
	    }
	}
	/**
	 * Check if author representation is correct
	 * The model knows the representation of a Author in the database and this is: 
	 *  	name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(40)
	 * @param array $newAuthor
	 * @return boolean indicating if the date format is valid or not
	 */
	public function isAuthorValid($newAuthor) {
		if(is_array($newAuthor)) {
			if (! empty ( $newAuthor ["name"] ) && ! empty ( $newAuthor ["surname"] ) && ! empty ( $newAuthor ["email"] ) && ! empty ( $newAuthor ["phone"] )) {
				if (($this->isLengthStringValid ( $newAuthor ["name"], TABLE_AUTHOR_NAME_LENGTH )) 
					&& ($this->isLengthStringValid ( $newAuthor ["surname"], TABLE_AUTHOR_SURNAME_LENGTH )) 
					&& ($this->isValidEmail ( $newAuthor ["email"] )) 
					&& ($this->isNumberInRangeValid ( $newAuthor ["phone"], TABLE_AUTHOR_MIN_PHONE, TABLE_AUTHOR_MAX_PHONE ))) {
						return true;
				}
			}
		}
		return false;
	}
	/**
	 * Check if user representation is correct
	 * The model knows the representation of a user in the database and this is: 
	 * name: varchar(25) surname: varchar(25) email: varchar(50) password: varchar(100)
	 * @param array $newUser
	 */
	public function isUserValid($newUser){
		var_dump($newUser);
		if(is_array($newUser)) { 
			if (! empty ( $newUser ["name"] ) && ! empty ( $newUser ["surname"] ) && ! empty ( $newUser ["email"] ) && ! empty ( $newUser ["password"] )) {
				if (($this->isLengthStringValid ( $newUser ["name"], TABLE_USER_NAME_LENGTH )) 
					&& ($this->isLengthStringValid ( $newUser ["surname"], TABLE_USER_SURNAME_LENGTH )) 
					&& ($this->isValidEmail ( $newUser ["email"] )) 
					&& ($this->isLengthStringValid ( $newUser ["password"], TABLE_USER_PASSWORD_LENGTH ))) {
						return true;
				}
			}
		}
		return false;
	}
	
	
}


?>