<?php
/**
* @author Admins
* Test isNumberInRangeValid Method
*/
class ValidateNumberInRange extends UnitTestCase 
{
	private $validation;
	public function setUp () 
	{
		$this->validation = new Validation();
 	}

	public function testIsNumberInRangeValid()
	{
		//Valid results
		$this->assertTrue($this->validation->isNumberInRangeValid(4, 2, 7));
		$this->assertTrue($this->validation->isNumberInRangeValid(4, 4, 5));
		$this->assertTrue($this->validation->isNumberInRangeValid(4, 1, 10));

		//Invalid Tests
		$this->assertFalse($this->validation->isNumberInRangeValid(NULL, NULL, NULL));
		$this->assertFalse($this->validation->isNumberInRangeValid(4, 20, 10));
		$this->assertFalse($this->validation->isNumberInRangeValid("4", "20", 10));
		$this->assertFalse($this->validation->isNumberInRangeValid("4", "20", "10"));
		$this->assertFalse($this->validation->isNumberInRangeValid("4", "20", 10));
		$this->assertFalse($this->validation->isNumberInRangeValid(40, 2, 10));

		$arr = array (
				"" 
		);
		$this->assertFalse($this->validation->isNumberInRangeValid($arr, $arr, 9));

		$v = new Validation();
		$this->assertFalse($this->validation->isNumberInRangeValid($v, 9, $v));

	}

	public function tearDown () 
    {
    	$this->validation = NULL;
	}

}

?>