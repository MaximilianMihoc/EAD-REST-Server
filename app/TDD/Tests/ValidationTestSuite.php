<?php
require_once('../simpletest/autorun.php');
class ValidationTestSuite extends TestSuite {
	function __construct() {
		parent::__construct ();
		include ('../Validation/Validation.php');
		$this->addFile ( "ValidateEmail.php" );
		$this->addFile ( "ValidateLengthString.php" );
		$this->addFile ( "ValidateNumberInRange.php" );
		$this->addFile ( "ValidateDateFormat.php" );
	}
}

?>