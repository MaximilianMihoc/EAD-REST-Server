<?php
/**
* @author Admins
* Test isLengthStringValid Method
*/
class ValidateLengthString extends UnitTestCase 
{
	private $validation;
	public function setUp () 
	{
		$this->validation = new Validation();
 	}

	public function testIsLengthStringValid()
	{
		//Valid tests
		$validate = $this->validation->isLengthStringValid("max", 3);
		$this->assertTrue($validate);
		$validate = $this->validation->isLengthStringValid("", 0);
		$this->assertTrue($validate);
		$validate = $this->validation->isLengthStringValid(" hello ", 7);
		$this->assertTrue($validate);

		// Invalid tests
		$validate = $this->validation->isLengthStringValid(null, null);
		$this->assertFalse($validate);
		$validate = $this->validation->isLengthStringValid("max", 2);
		$this->assertFalse($validate);

		//passing arrays
		$arr = array (
				"" 
		);
		$validateEmail = $this->validation->isLengthStringValid($arr, 9);
		$this->assertFalse($validateEmail);

		//passing objects
		$v = new Validation();
		$validateEmail = $this->validation->isLengthStringValid($v, 9);
		$this->assertFalse($validateEmail);



	}

	public function tearDown () 
    {
    	$this->validation = NULL;
	}

}

?>