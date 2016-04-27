<?php
require_once('../simpletest/autorun.php');
require_once "../../conf/config.inc.php";
class ValidationTestSuite extends TestSuite {
	function __construct() {
		parent::__construct ();
		include ('../Validation/Validation.php');
		$this->addFile ( "ValidateEmail.php" );
		$this->addFile ( "ValidateLengthString.php" );
		$this->addFile ( "ValidateNumberInRange.php" );
		$this->addFile ( "ValidateDateFormat.php" );
		$this->addFile ( "ValidateAuthor.php" );
		$this->addFile ( "ValidateBook.php" );
		$this->addFile ( "ValidateUser.php" );
	}
}

?>